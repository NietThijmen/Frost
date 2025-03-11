<?php

require_once  __DIR__ . '/vendor/autoload.php';

\App\Helper\Modules\ServerProvider::AddProvider(
    'Hetzner',
    \HetznerServerProvider\ServerManager::class,
    function () {
        return [
            'location' => [
                'label' => 'Location',
                'type' => 'select',
                'options' => \HetznerServerProvider\ConfigManager::getLocations(),
                'placeholder' => 'Select a location',
                'required' => true,
            ],

            'server_type' => [
                'label' => 'Server Type',
                'type' => 'select',
                'options' => \HetznerServerProvider\ConfigManager::GetServerTypes(),
                'placeholder' => 'Select a server type',
                'required' => true,
            ],
        ];
    },
);
