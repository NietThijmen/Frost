<?php

require_once  __DIR__ . '/vendor/autoload.php';

\App\Helper\Modules\ServerProviderSettings::AddProvider(
    providerName: 'Hetzner',
    onSave: function ($data) {
        $organisation = app()->organisation;
        $authData = $org->authData ?? [];
        $authData['hetzner'] = $data;
        $organisation->authData = $authData;
        $organisation->save();
    },
    formFields: function () {
        return [
            'api_key' => [
                'label' => 'API Key',
                'type' => 'text',
                'placeholder' => 'Enter your Hetzner API key',
                'required' => true,
            ],
        ];
    }
);
