<?php

return [
    'about_assets_title'           => 'Apie turtą',
    'about_assets_text'            => 'Turtas - tai daiktai, kurie stebimi serijos numeriu arba turinio žyma. Jie dažniausiai būna vertingesni dalykai, kai svarbu nustatyti konkretų elementą.',
    'archived'  				=> 'Archyvuota',
    'asset'  					=> 'Įranga',
    'bulk_checkout'             => 'Išduota įranga',
    'bulk_checkin'              => 'Priimti įrangą',
    'checkin'  					=> 'Išduota įranga',
    'checkout'  				=> 'Patikros turtas',
    'clone'  					=> 'Kopijuoti įrangą',
    'deployable'  				=> 'Naudojamas',
    'deleted'  					=> 'Ši įranga buvo ištrinta.',
    'delete_confirm'            => 'Ar jūs tikrai norite ištrinti šią įrangą?',
    'edit'  					=> 'Keisti įrangą',
    'model_deleted'  			=> 'Šios įrangos modelis yra ištrintas. Pirma turite atstattyti modelį, tada galėsite atstatyti įrangą.',
    'model_invalid'             => 'Neteisingas įrangos modelis.',
    'model_invalid_fix'         => 'Įranga turi būti pataisyta prieš ją įregistruojant ar išregistruojant.',
    'requestable'               => 'Reiklaujamas',
    'requested'				    => 'Užklausta',
    'not_requestable'           => 'Nereikalaujamas',
    'requestable_status_warning' => 'Nekeiskite prašomos įrangos statuso',
    'restore'  					=> 'Atkurti įrangą',
    'pending'  					=> 'Vykdoma',
    'undeployable'  			=> 'Negalimas naudoti',
    'undeployable_tooltip'  	=> 'Šios įrangos statusas yra "nediegtinas", todėl jos negalima išduoti.',
    'view'  					=> 'Peržiūrėti įrangą',
    'csv_error' => 'Jūsų CSV faile yra klaida:',
    'import_text' => '<p>Upload a CSV that contains asset history. The assets and users MUST already exist in the system, or they will be skipped. Matching assets for history import happens against the asset tag. We will try to find a matching user based on the user\'s name you provide, and the criteria you select below. If you do not select any criteria below, it will simply try to match on the username format you configured in the <code>Admin &gt; General Settings</code>.</p><p>Fields included in the CSV must match the headers: <strong>Asset Tag, Name, Checkout Date, Checkin Date</strong>. Any additional fields will be ignored. </p><p>Checkin Date: blank or future checkin dates will checkout items to associated user.  Excluding the Checkin Date column will create a checkin date with todays date.</p>
    ',
    'csv_import_match_f-l' => 'Try to match users by <strong>firstname.lastname</strong> (<code>jane.smith</code>) format',
    'csv_import_match_initial_last' => 'Try to match users by <strong>first initial last name</strong> (<code>jsmith</code>) format',
    'csv_import_match_first' => 'Try to match users by <strong>first name</strong> (<code>jane</code>) format',
    'csv_import_match_email' => 'Try to match users by <strong>email</strong> as username',
    'csv_import_match_username' => 'Try to match users by <strong>username</strong>',
    'error_messages' => 'Klaidos pranešimai:',
    'success_messages' => 'Sėkmės pranešimai:',
    'alert_details' => 'Žemiau pateikta detalesnė informacija.',
    'custom_export' => 'Nestandartinis eksportas',
    'mfg_warranty_lookup' => ':manufacturer garantinio remonto statuso peržiūra',
    'user_department' => 'Naudotojo departamentas',
];
