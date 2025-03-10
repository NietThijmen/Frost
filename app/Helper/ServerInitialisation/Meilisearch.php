<?php

namespace App\Helper\ServerInitialisation;

class Meilisearch extends BaseCreator
{

    protected $meilisearchVersion;
    protected $meilisearchOs;

    protected array $steps = [];
    protected function generateSteps()
    {
        $this->steps = [
            'apt-get update -y',
            'apt-get upgrade -y',
            'apt-get install nginx -y', // used for the web server
            'mkdir /srv',
            'mkdir /srv/meilisearch',
            'mkdir /srv/meilisearch/versions',
            'mkdir /srv/meilisearch/data'
        ];

        $this->steps[] = 'mkdir /srv/meilisearch/versions/' . $this->meilisearchVersion;
        $this->steps[] = "curl -OL https://github.com/meilisearch/meilisearch/releases/download/{$this->meilisearchVersion}/{$this->meilisearchOs}";
        $this->steps[] = "mv {$this->meilisearchOs} /srv/meilisearch/versions/{$this->meilisearchVersion}/meilisearch";
        $this->steps[] = "chmod +x /srv/meilisearch/versions/{$this->meilisearchVersion}/meilisearch";
        $this->steps[] = 'systemctl start nginx';
        $this->steps[] = 'systemctl enable nginx';
    }

    public function __construct(
        string $name,
        string $host,
        string $username,
        string $password,
        string $meilisearchVersion,
        string $meilisearchOs
    )
    {
        $this->meilisearchOs = $meilisearchOs;
        $this->meilisearchVersion = $meilisearchVersion;

        parent::__construct($name, $host, $username, $password);
        $this->generateSteps();
    }


}
