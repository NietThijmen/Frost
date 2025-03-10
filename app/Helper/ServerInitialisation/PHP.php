<?php

namespace App\Helper\ServerInitialisation;

class PHP extends BaseCreator
{

    protected $phpVersion;

    protected array $steps = [];
    protected array $packages = [
        'fpm',
        'mysql',
        'curl',
        'gd',
        'mbstring',
        'xml',
        'zip',
    ];
    protected function generateSteps()
    {
        $this->steps = [
            'apt-get update -y',
            'apt-get upgrade -y',
            'apt-get install nginx -y', // used for the web server
            'apt-get install lsb-release apt-transport-https ca-certificates -y',
            'wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg',
            'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list',
            'apt update -y',
            'apt install php' . $this->phpVersion . ' -y'
        ];

        foreach ($this->packages as $package) {
            $this->steps[] = 'apt-get install php' . $this->phpVersion . '-' . $package . ' -y';
        }

        $this->steps[] = 'systemctl start nginx';
        $this->steps[] = 'systemctl enable nginx';
        $this->steps[] = 'systemctl start php' . $this->phpVersion . '-fpm';
        $this->steps[] = 'systemctl enable php' . $this->phpVersion . '-fpm';
    }

    public function __construct(
        string $name,
        string $host,
        string $username,
        string $password,
        string $phpVersion
    )
    {
        parent::__construct($name, $host, $username, $password);
        $this->phpVersion = $phpVersion;
        $this->generateSteps();
    }


}
