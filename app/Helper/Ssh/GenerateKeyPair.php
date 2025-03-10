<?php

namespace App\Helper\Ssh;

use phpseclib3\Crypt\RSA;

class GenerateKeyPair
{
    private $privateKey;
    private $publicKey;

    public function __construct(
        string $label = "seclib-ssh-key"
    )
    {
        $key = RSA::createKey(4096);

        $this->privateKey = $key->toString(
            'OpenSSH'
        );
        $this->publicKey = $key->getPublicKey()->toString(
            'OpenSSH',
            [
                'comment' => $label
            ]
        );
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }
}
