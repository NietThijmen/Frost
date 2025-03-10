<?php

namespace App\Helper\ServerInitialisation;

use App\Helper\Ssh\Connection;
use App\Helper\Ssh\GenerateKeyPair;

class BaseCreator
{
    protected Connection $connection;
    protected array $steps = [];
    public function __construct(
        protected string $name,
        protected string $host,
        protected string $username,
        protected string $password
    ) {
        $this->connection = new Connection($this->host, $this->username, null, $this->password);
    }

    public function setupSshKey()
    {
        $keyPair = new GenerateKeyPair($this->name);

        \Storage::disk('ssh-keys')->makeDirectory('ssh-keys/' . $this->name);
        \Storage::disk('ssh-keys')->put('ssh-keys/' . $this->name . '/id_rsa', $keyPair->getPrivateKey());
        \Storage::disk('ssh-keys')->put('ssh-keys/' . $this->name . '/id_rsa.pub', $keyPair->getPublicKey());

        $this->connection->exec('mkdir -p ~/.ssh');
        $this->connection->exec('echo "' . $keyPair->getPublicKey() . '" >> ~/.ssh/authorized_keys');
    }

    public function sshConnect()
    {
        $this->connection = new Connection($this->host, $this->username,  $this->name . '/id_rsa', null);
    }

    public function sshDisconnect()
    {
        $this->connection->close();
    }

    public function initialise()
    {

        $this->setupSshKey();
        $this->connection->close();


        foreach ($this->steps as $step) {
            $this->sshConnect();
            $response = $this->connection->exec($step);
            \Log::debug($response);
            echo $response;
            $this->sshDisconnect();
        }
        return true;
    }
}
