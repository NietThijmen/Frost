<?php

namespace App\Helper\Modules;

class ServerProvider
{
    public static array $providers = [];

    public static function AddProvider(
        string $providerName,
        string $providerClass,

        ?callable $formFields,
        ?array $formRules = [],
    )
    {
        self::$providers[$providerName] = [
            'provider' => $providerClass,
            'formFields' => $formFields,
            'formRules' => $formRules,
        ];
    }

    public static function GetProviders()
    {
        return self::$providers;
    }
}
