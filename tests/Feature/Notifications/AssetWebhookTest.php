<?php

namespace Tests\Feature\Notifications;

use App\Events\CheckoutableCheckedIn;
use App\Events\CheckoutableCheckedOut;
use App\Models\Asset;
use App\Models\Location;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\CheckinAssetNotification;
use App\Notifications\CheckoutAssetNotification;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Tests\Support\InteractsWithSettings;
use Tests\TestCase;

class AssetWebhookTest extends TestCase
{
    use InteractsWithSettings;

    public function targets(): array
    {
        return [
            'Asset checked out to user' => [fn() => User::factory()->create()],
            'Asset checked out to asset' => [fn() => $this->createAsset()],
            'Asset checked out to location' => [fn() => Location::factory()->create()],
        ];
    }

    /** @dataProvider targets */
    public function testAssetCheckoutSendsWebhookNotificationWhenSettingEnabled($checkoutTarget)
    {
        Notification::fake();

        $this->settings->enableSlackWebhook();

        event(new CheckoutableCheckedOut(
            $this->createAsset(),
            $checkoutTarget(),
            User::factory()->superuser()->create(),
            ''
        ));

        Notification::assertSentTo(
            new AnonymousNotifiable,
            CheckoutAssetNotification::class,
            function ($notification, $channels, $notifiable) {
                return $notifiable->routes['slack'] === Setting::getSettings()->webhook_endpoint;
            }
        );
    }

    /** @dataProvider targets */
    public function testAssetCheckoutDoesNotSendWebhookNotificationWhenSettingDisabled($checkoutTarget)
    {
        Notification::fake();

        $this->settings->disableWebhook();

        event(new CheckoutableCheckedOut(
            $this->createAsset(),
            $checkoutTarget(),
            User::factory()->superuser()->create(),
            ''
        ));

        Notification::assertNotSentTo(new AnonymousNotifiable, CheckoutAssetNotification::class);
    }

    /** @dataProvider targets */
    public function testAssetCheckinSendsWebhookNotificationWhenSettingEnabled($checkoutTarget)
    {
        Notification::fake();

        $this->settings->enableSlackWebhook();

        event(new CheckoutableCheckedIn(
            $this->createAsset(),
            $checkoutTarget(),
            User::factory()->superuser()->create(),
            ''
        ));

        Notification::assertSentTo(
            new AnonymousNotifiable,
            CheckinAssetNotification::class,
            function ($notification, $channels, $notifiable) {
                return $notifiable->routes['slack'] === Setting::getSettings()->webhook_endpoint;
            }
        );
    }

    /** @dataProvider targets */
    public function testAssetCheckinDoesNotSendWebhookNotificationWhenSettingDisabled($checkoutTarget)
    {
        Notification::fake();

        $this->settings->disableWebhook();

        event(new CheckoutableCheckedIn(
            $this->createAsset(),
            $checkoutTarget(),
            User::factory()->superuser()->create(),
            ''
        ));

        Notification::assertNotSentTo(new AnonymousNotifiable, CheckinAssetNotification::class);
    }

    public function testCheckInEmailSentToUserIfSettingEnabled()
    {
        Notification::fake();

        $user = User::factory()->create();
        $asset = Asset::factory()->assignedToUser($user)->create();

        $asset->model->category->update(['checkin_email' => true]);

        event(new CheckoutableCheckedIn(
            $asset,
            $user,
            User::factory()->checkinAssets()->create(),
            ''
        ));

        Notification::assertSentTo(
            [$user],
            function (CheckinAssetNotification $notification, $channels) {
                return in_array('mail', $channels);
            },
        );
    }

    public function testCheckInEmailNotSentToUserIfSettingDisabled()
    {
        Notification::fake();

        $user = User::factory()->create();
        $asset = Asset::factory()->assignedToUser($user)->create();

        $asset->model->category->update(['checkin_email' => false]);

        event(new CheckoutableCheckedIn(
            $asset,
            $user,
            User::factory()->checkinAssets()->create(),
            ''
        ));

        Notification::assertNotSentTo(
            [$user],
            function (CheckinAssetNotification $notification, $channels) {
                return in_array('mail', $channels);
            }
        );
    }

    private function createAsset()
    {
        return Asset::factory()->laptopMbp()->create();
    }
}
