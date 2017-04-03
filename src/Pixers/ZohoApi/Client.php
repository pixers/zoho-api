<?php

namespace Pixers\ZohoApi;

use GuzzleHttp\Client as GuzzleClient;
use Pixers\ZohoApi\Exception\InvalidRequestException;
use Pixers\ZohoApi\Exception\InvalidArgumentException;

/**
 * Client
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2017 PIXERS Ltd
 */
class Client
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    const AUTH_TOKEN_PARAM = 'authtoken';
    const SCOPE_PARAM = 'scope';
    const ENDPOINT_PARAM = 'endpoint';
    const XML_DATA_PARAM = 'xmlData';

    /**
     * @var array
     */
    protected $config;

    /**
     * @var GuzzleClient
     */
    protected $guzzleClient;

    /**
     * Initialization.
     */
    public function __construct($authtoken, $endPoint = 'https://crm.zoho.com/crm/private/json/')
    {
        $this->config = [
            self::AUTH_TOKEN_PARAM => $authtoken,
            self::ENDPOINT_PARAM => rtrim($endPoint, '/'),
            self::SCOPE_PARAM => 'crmapi'
        ];
        
        foreach ($this->config as $key => $parameter) {
            if (empty($parameter)) {
                throw new InvalidArgumentException($key . ' parameter is required', $parameter);
            }
        }
    }
    
    /**
     * Sets GuzzleClient.
     *
     * @param GuzzleClient $guzzleClient
     */
    public function setGuzzleClient(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * Gets GuzzleClient.
     *
     * @return GuzzleClient
     */
    public function getGuzzleClient()
    {
        if (!$this->guzzleClient) {
            $this->guzzleClient = new GuzzleClient();
        }
        return $this->guzzleClient;
    }

    /**
     * Send POST request to Zoho API.
     *
     * @param  string $method API Method
     * @param  array  $data   Request data
     * @return array
     */
    public function doPost($method, array $data)
    {
        return $this->doRequest(self::METHOD_POST, $method, $data);
    }

    /**
     * Send GET request to Zoho API.
     *
     * @param  string $method API Method
     * @param  array  $data   Request data
     * @return array
     */
    public function doGet($method, array $data)
    {
        return $this->doRequest(self::METHOD_GET, $method, $data);
    }

    /**
     * Send request to Zoho API.
     *
     * @param  string $method    HTTP Method
     * @param  string $apiMethod API Method
     * @param  array  $data      Request data
     * @return array
     */
    protected function doRequest($method, $apiMethod, array $data = [])
    {
        $url = $this->config[self::ENDPOINT_PARAM] . '/' . $apiMethod;

        $data = $this->mergeData($this->createAuthData(), $data);
        $url = $url . '?' . http_build_query($data);

        $response = $this->getGuzzleClient()->request($method, $url, $data);
        $responseContent = \GuzzleHttp\json_decode($response->getBody());

        if (!property_exists($responseContent, 'response') ||
                ($responseContent->response && property_exists($responseContent->response, 'error'))) {
            throw new InvalidRequestException($method, $url, $data, $response);
        }

        return $responseContent->response;
    }

    /**
     * Returns an array of authentication data.
     *
     * @return array
     */
    protected function createAuthData()
    {
        return [self::AUTH_TOKEN_PARAM => $this->config[self::AUTH_TOKEN_PARAM]];
    }
    
    /**
     * Merge data and removing null values.
     *
     * @param  array $base         The array in which elements are replaced
     * @param  array $replacements The array from which elements will be extracted
     * @return array
     */
    private function mergeData(array $base, array $replacements)
    {
        return array_filter(array_merge($base, $replacements), function($value) {
            return $value !== null;
        });
    }
}
