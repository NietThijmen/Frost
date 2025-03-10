<?php

namespace App\Helper\Ssh;

use phpseclib3\Crypt\RSA;
use phpseclib3\Net\SSH2;

class Connection
{
    private $host;

    private $connection;

    public function __construct(
        $host,
        $username,
        ?string $private_key_path,
        ?string $password
    )
    {
        $this->host = $host;

        if($private_key_path) {
            $this->private_key = \Storage::disk(
                'ssh-keys'
            )->get('ssh-keys/' . $private_key_path);

            $secPrivateKey = RSA::loadPrivateKey($this->private_key);
        }


        $this->connection = new SSH2(
            $this->host
        );


        $this->connection->login(
            $username,
            $secPrivateKey ?? $password
        );
    }

    public function is_active()
    {
        return $this->connection->isConnected();
    }

    public function exec($command)
    {
        return $this->connection->exec($command);
    }

    public function close()
    {
        $this->connection->disconnect();
    }
}
