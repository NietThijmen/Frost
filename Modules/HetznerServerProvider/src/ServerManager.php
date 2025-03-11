<?php

namespace HetznerServerProvider;

use App\Helper\Ssh\GenerateKeyPair;
use LKDev\HetznerCloud\Models\Networks\Subnet;

class ServerManager
{
    public function __construct()
    {
        $organisation = app()->organisation;
    }

    private function createNetworkIfNotExists()
    {
        $client =HetznerSdkFactory::getClient();
        $network = $client->networks()->getByName(
            app()->organisation->name
        );

        if($network) {
            return $network;
        }

        return $client->networks()->create(
            app()->organisation->name,
            '10.0.0.0/16',
            [
                new Subnet(Subnet::TYPE_CLOUD, '10.0.0.0/24', 'eu-central'),
            ]
        );
    }
    private function generateSshKeyPair($data)
    {
        $client = HetznerSdkFactory::getClient();

        $keypair = new GenerateKeyPair(
            \Str::slug($data['name'])
        );

        $path = "ssh-keys/servers/" . \Str::slug(app()->organisation->name) . "/" . \Str::slug($data['name']) . "/";

        \Storage::disk('ssh-keys')->put($path . 'rsa', $keypair->getPrivateKey());
        \Storage::disk('ssh-keys')->put($path . 'rsa.pub', $keypair->getPublicKey());

        $ssh_key = $client->sshKeys()->create(
            \Str::slug($data['name']),
            $keypair->getPublicKey()
        );

        return $ssh_key->id;
    }
    public function createServer($data)
    {
        $client =HetznerSdkFactory::getClient();
        $sshKey = $this->generateSshKeyPair($data);

        $data = $client->servers()->createInLocation(
            name: \Str::slug($data['name']),
            serverType: $client->serverTypes()->getById($data['server_type']),
            image: $client->images()->getByName('debian-12'),
            location: $client->locations()->getById($data['location']),
            ssh_keys: [$sshKey],
            networks: [$this->createNetworkIfNotExists()->id],
        );
    }
}
