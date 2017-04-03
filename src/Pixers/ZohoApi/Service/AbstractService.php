<?php

namespace Pixers\ZohoApi\Service;

use Pixers\ZohoApi\Client;

/**
 * AbstractService
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2017 PIXERS Ltd
 */
abstract class AbstractService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Replaces elements from passed arrays into the first array recursively.
     *
     * @param  array $base         The array in which elements are replaced
     * @param  array $replacements The array from which elements will be extracted
     * @return array
     */
    protected static function mergeData(array $base, array $replacements)
    {
        return array_replace_recursive($base, $replacements);
    }
}
