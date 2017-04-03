<?php

namespace Pixers\ZohoApi\Exception;

/**
 * InvalidArgumentException
 *
 * @author Sylwester Łuczak <sylwester.luczak@pixers.pl>
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2017 PIXERS Ltd
 */
class InvalidArgumentException extends ZohoApiException
{
    /**
     * @var array
     */
    protected $argumentValue;
    
    /**
     * Extended Exception constructor.
     *
     * @param string          $message       Error message
     * @param mixed           $argumentValue Argument value
     * @param int             $code          Error code
     * @param \Exception|null $previous      Previous exception
     */
    public function __construct($message, $argumentValue,  $code = 0, \Exception $previous = null)
    {
        $this->argumentValue = $argumentValue;
        
        parent::__construct($message, $code, $previous);
    }
    
    /**
     * Return argument value.
     *
     * @return mixed
     */
    public function getArgumentValue()
    {
        return $this->parameterValue;
    }
}
