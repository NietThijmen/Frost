<?php

namespace App\Helper\ServerInitialisation;

use App\Helper\Ssh\Connection;
use App\Helper\Ssh\GenerateKeyPair;

class Nginx extends BaseCreator
{
    // used mostly for the reverse proxy
    protected array $steps = [
        'apt-get update -y',
        'apt-get upgrade -y',
        'apt-get install nginx -y',
        'systemctl start nginx',
        'systemctl enable nginx',
    ];

    public function __construct(
        string $name,
        string $host,
        string $username,
        string $password
    )
    {
        parent::__construct($name, $host, $username, $password);
    }

}
