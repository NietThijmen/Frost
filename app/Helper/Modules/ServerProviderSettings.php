<?php

namespace App\Helper\Modules;

class ServerProviderSettings
{
    public static array $providers = [];

    public static function AddProvider(
        string $providerName,
        ?callable $onSave,
        ?callable $formFields,
        ?array $formRules = [],
    )
    {
        self::$providers[$providerName] = [
            'onSave' => $onSave,
            'formFields' => $formFields,
            'formRules' => $formRules,
        ];
    }

    public static function GetProviders()
    {
        return self::$providers;
    }
}
