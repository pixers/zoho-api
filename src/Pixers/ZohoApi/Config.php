<?php

namespace Pixers\ZohoApi;

/**
 * Config
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2016 PIXERS Ltd
 */
class Config
{
    const NEW_FORMAT_PARAM = 'newFormat';
    const VERSION_PARAM = 'version';
    const DUPLICATE_CHECK_PARAM = 'duplicateCheck';
    const WF_TRIGGER_PARAM = 'wfTrigger';

    const PARAMS_DEFAULT_VALUES = [
        self::NEW_FORMAT_PARAM => 1,
        self::VERSION_PARAM => 1,
        self::DUPLICATE_CHECK_PARAM => 2,
        self::WF_TRIGGER_PARAM => 'true',
    ];

    const INSERT_RECORDS_PARAMS = [
        self::NEW_FORMAT_PARAM => 1,
        self::VERSION_PARAM => 1,
        self::DUPLICATE_CHECK_PARAM => 2,
        self::WF_TRIGGER_PARAM => 'true',
    ];

}
