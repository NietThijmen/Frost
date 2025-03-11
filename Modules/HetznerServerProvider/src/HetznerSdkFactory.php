<?php

namespace HetznerServerProvider;

use LKDev\HetznerCloud\HetznerAPIClient;

class HetznerSdkFactory
{
    public static HetznerAPIClient $client;
    public static function getClient()
    {

        $api_token = app()->organisation->authData['hetzner']['api_key'];
        return  new HetznerAPIClient($api_token);
    }
}
