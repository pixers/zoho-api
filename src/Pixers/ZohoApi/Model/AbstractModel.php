<?php

namespace Pixers\ZohoApi\Model;

/**
 * AbstractModel
 *
 * @author Michał Kanak <kanakmichal@gmail.com>
 * @copyright 2017 PIXERS Ltd
 */
abstract class AbstractModel
{

    /**
     * @var array
     */
    protected $additionalData = [];

    /**
     * @return array
     */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    /**
     * @param array $data
     * @return \Pixers\ZohoApi\Model\AbstractModel
     */
    public function setAdditionalData(array $data = [])
    {
        $this->additionalData = $data;

        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return \Pixers\ZohoApi\Model\AbstractModel
     */
    public function setAdditionalDataProperty($name, $value = '')
    {
        $this->setAdditionalData(array_merge($this->getAdditionalData(), [$name => $value]));

        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getAdditionalDataProperty($name)
    {
        $addtionalData = $this->getAdditionalData();

        if (isset($addtionalData[$name])) {
            return $addtionalData[$name];
        }

        return null;
    }

    /**
     * Universal getter
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return property_exists($this, $property) ? $this->$property : null;
    }

    /**
     * Universal setter
     *
     * @param string $property
     * @param mixed $value
     * @return mixed
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    /**
     * deserializeXml
     *
     * @param string $xml
     * @throws Exception
     * @return \Pixers\ZohoApi\Model\AbstractModel
     */
    final public function deserializeFromXml($xml = '')
    {
        try {
            $element = new \SimpleXMLElement($xml);
        } catch (\Exception $e) {
            return null;
        }

        foreach ($element as $name => $value) {
            $property = $this->getPropertyByApiName($name);
            if (property_exists($this, $property)) {
                $this->$property = stripslashes(urldecode(htmlspecialchars_decode($value)));
            } else {
                $this->setAdditionalDataProperty($name, stripslashes(urldecode(htmlspecialchars_decode($value))));
            }
        }

        return $this;
    }

    /**
     * deserializeJson
     *
     * @param string $json
     * @return array
     */
    final public function deserializeFromJson($json = '')
    {
        return json_decode($json);
    }

    /**
     * serializeXml
     *
     * @param array $dataArray
     * @param string $openingBracket
     * @return string
     */
    final public function serializeToXml()
    {
        $dataArray = array_merge($this->getFieldsForApiMapping(), $this->getAdditionalData());
        $xml = "<" . $this->getApiName() . ">";
        $xml .= "<row no=\"1\">";

        foreach ($dataArray as $key => $val) {
            if (null === $val) {
                continue;
            }

            $xml .= "<FL val=\"$key\"><![CDATA[" . trim($val) . "]]></FL>";
        }

        $xml .= "</row>";
        $xml .= "</" . $this->getApiName() . ">";

        return $xml;
    }

    /**
     * @param string $name
     * @return string
     */
    final public function getPropertyByApiName($name)
    {
        $result = '';
        $parts = explode(' ', $name);
        foreach ($parts as $value) {
            $result .= ucfirst(trim(strtolower($value)));
        }

        return lcfirst($result);
    }

}
