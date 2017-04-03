<?php

namespace Pixers\ZohoApi\Methods\Traits;

use Pixers\ZohoApi\Model\ModelInterface;
use Pixers\ZohoApi\Client;
use Pixers\ZohoApi\Config;

/**
 * insertRecordsMethodTrait
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2017 PIXERS Ltd
 */
trait insertRecordsMethodTrait
{

    /**
     * insertRecords
     *
     * @param ModelInterface $model
     * @param array $extraParams
     * @return array
     */
    public function insertRecords(ModelInterface $model, array $extraParams = [])
    {        
        $data = array_merge(
                    [Client::XML_DATA_PARAM => $model->serializeToXml()],
                    array_merge($extraParams, Config::INSERT_RECORDS_PARAMS)
                );

        return $this->client->doPost($model->getApiName() . '/insertRecords', $data);
    }
}
