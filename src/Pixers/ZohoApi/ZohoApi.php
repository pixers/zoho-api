<?php

namespace Pixers\ZohoApi;

use Pixers\ZohoApi\Client;
use Pixers\ZohoApi\Service;

/**
 * ZohoApi
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2017 PIXERS Ltd
 */
class ZohoApi
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $services;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->services = [];
    }

    /**
     * @return LeadService
     */
    public function getLeadService()
    {
        return $this->getService(Service\LeadService::class);
    }

    /**
     * @param  string $className
     * @return mixed
     */
    protected function getService($className)
    {
        if (!isset($this->services[$className])) {
            $this->services[$className] = new $className($this->client);
        }
        return $this->services[$className];
    }
}
