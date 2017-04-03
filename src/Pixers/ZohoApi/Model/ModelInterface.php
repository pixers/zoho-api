<?php

namespace Pixers\ZohoApi\Model;

/**
 * ModelInterface
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2017 PIXERS Ltd
 */
interface ModelInterface
{
    public function getApiName();
    public function getFieldsForApiMapping();
}
