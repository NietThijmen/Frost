<?php

namespace HetznerServerProvider;

class ConfigManager
{
    public static function getLocations():array
    {
        $client = HetznerSdkFactory::getClient();

        $locations =  $client->locations()->all();
        $output = [];

        foreach ($locations as $location) {
            $output[$location->id] = $location->name . ' (' . $location->description . ')';
        }

        return $output;
    }

    public static function GetServerTypes():array
    {
        $client = HetznerSdkFactory::getClient();
        $serverTypes = $client->serverTypes()->all();
        $output = [];
        foreach ($serverTypes as $serverType) {
            $output[$serverType->id] = $serverType->name . ' (' . $serverType->cores . '|' . $serverType->memory.  ')';
        }

        return $output;
    }
}
