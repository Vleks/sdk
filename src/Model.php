<?php namespace Vleks\SDK;

use \DOMXPath;
use \DOMElement;
use Vleks\SDK\Exceptions;

abstract class Model
{
    protected $fields = array ();

    public function __construct($data = null)
    {
        if (!is_null($data)) {
            if ($this->isAssociativeArray($data)) {
                $this->fromAssociativeArray($data);
            } elseif ($this->isDOMElement($data)) {
                $this->fromDOMElement($data);
            } else {
                throw new Exceptions\ClientException('Unable to construct from provided data. Be sure to pass an associative array or DOMElement.');
            }
        }
    }

    /**
     * Support for virtual property getters
     *
     * @example $action->Property;
     * @example $action->getProperty();
     * @param   string  $propertyName
     * @return  mixed   result of get$propertyName
     */
    public function __get($propertyName)
    {
        $getter = 'get' . $propertyName;
        return $this->$getter();
    }

    /**
     * Support for virtual property setters
     *
     * @example $action->Property = 'Value';
     * @example $action->setProperty('Value');
     * @param   string  $propertyName
     * @param   mixed   $propertyValue
     * @return  this instance
     */
    public function __set($propertyName, $propertyValue)
    {
        $setter = 'set' . $propertyName;
        $this->setter($propertyValue);

        return $this;
    }

    /**
     * Construct this object from an associative array
     *
     * @param   array   $array
     * @return  void
     */
    private function fromAssociativeArray(array $array)
    {
        foreach ($this->fields as $fieldName => $field) {
            $fieldType = $field['type'];

            if ($this->isNumericArray($fieldType)) {
                if ($this->isComplexType($fieldType[0])) {
                    if (array_key_exists($fieldName, $array)) {
                        $elements = $array[$fieldName];

                        if (!$this->isNumericArray($elements)) {
                            $elements = array($elements);
                        }

                        if (1 <= count ($elements)) {
                            foreach ($elements as $element) {
                                $this->fields[$fieldName]['value'][] = new $fieldType[0]($element);
                            }
                        }
                    }
                } else {
                    if (array_key_exists($fieldName, $array)) {
                        $elements = $array[$fieldName];

                        if (!$this->isNumericArray($elements)) {
                            $elements = array($elements);
                        }

                        if (1 <= count($elements)) {
                            foreach ($elements as $element) {
                                $this->fields[$fieldName]['value'][] = $this->formatDOMElementValue($element, $fieldType[0]);
                            }
                        }
                    }
                }
            } else {
                if ($this->isComplexType($fieldType)) {
                    if (array_key_exists($fieldName, $array)) {
                        $this->fields[$fieldName]['value'] = new $fieldType($array[$fieldName]);
                    }
                } else {
                    if (array_key_exists($fieldName, $array)) {
                        $setter = 'set' . $fieldName;

                        if (method_exists($this, $setter)) {
                            $this->$setter($array[$fieldName]);
                        } else {
                            $this->fields[$fieldName]['value'] = $this->formatDOMElementValue($array[$fieldName], $fieldType);
                        }
                    }
                }
            }
        }
    }

    /**
     * Construct this object from a DOMElement
     *
     * @param   DOMElement  $dom
     * @return  void
     */
    private function fromDOMElement(DOMElement $dom)
    {
        $xpath = new DOMXPath($dom->ownerDocument);

        foreach ($this->fields as $fieldName => $field) {
            $fieldType = $field['type'];

            if ($this->isNumericArray($fieldType)) {
                if ($this->isComplexType($fieldType[0])) {
                    $elements = $xpath->query("./$fieldName", $dom);

                    if (0 < $elements->length) {
                        foreach ($elements as $element) {
                            $this->fields[$fieldName]['value'][] = new $fieldType[0]($element);
                        }
                    }
                } else {
                    $elements = $xpath->query("./$fieldName", $dom);

                    if (0 < $elements->length) {
                        foreach ($elements as $element) {
                            $text = $xpath->query('./text()', $element);
                            $this->fields[$fieldName]['value'][] = $this->formatDOMElementValue($text->item(0)->data, $fieldType[0]);
                        }
                    }
                }
            } else {
                if ($this->isComplexType($fieldType)) {
                    $element = $xpath->query("./$fieldName", $dom);

                    if (1 === $element->length) {
                        $this->fields[$fieldName]['value'] = new $fieldType($element->item(0));
                    }
                } else {
                    $element = $xpath->query("./$fieldName/text()", $dom);
                    $data    = null;

                    if (1 === $element->length) {
                        $data = $this->formatDOMElementValue($element->item(0)->data, $fieldType);
                    }

                    $this->fields[$fieldName]['value'] = $data;
                }
            }
        }
    }

    /**
     * Creates a XML fragment representation of this object
     *
     * The root node name is determined by the caller
     * This fragment returns inner fields representation only
     *
     * @return  string  XML fragment representation of this object
     */
    public function toXMLFragment()
    {
        $xml = '';

        foreach ($this->fields as $fieldName => $field) {
            $fieldValue = $field['value'];

            if (!is_null($fieldValue)) {
                $fieldType = $field['type'];

                if ($this->isNumericArray($fieldType)) {
                    if ($this->isComplexType($fieldType[0])) {
                        foreach ($fieldValue as $item) {
                            $xml .= sprintf('<%1$s>%2$s</%1$s>', $fieldName, $item->toXMLFragment());
                        }
                    } else {
                        foreach ($fieldValue as $item) {
                            $xml .= sprintf('<%1$s>%2$s</%1$s>', $fieldName, $this->escapeXML(
                                $this->formatXMLFragmentValue($item, $fieldType[0])
                            ));
                        }
                    }
                } else {
                    if ($this->isComplexType($fieldType)) {
                        $xml .= sprintf('<%1$s>%2$s</%1$s>', $fieldName, $fieldValue->toXMLFragment());
                    } else {
                        $xml .= sprintf('<%1$s>%2$s</%1$s>', $fieldName, $this->escapeXML(
                            $this->formatXMLFragmentValue($fieldValue, $fieldType)
                        ));
                    }
                }
            }
        }

        return $xml;
    }

    /**
     * Formats a variable by a given format
     *
     * @param   mixed   $var
     * @param   string  $format
     * @return  mixed   Formatted variable
     */
    private function formatDOMElementValue($var, $format = 'string')
    {
        switch ($format) {
            case 'bool':
                return filter_var ($var, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                break;

            case 'int':
                return (int) $var == $var ? (int) $var : null;
                break;

            case 'float':
                return (float) $var == $var ? (float) $var : null;
                break;

            case 'string':
                return (string) $var == $var ? (string) $var : null;
                break;

            case 'datetime':
                return date ('Y-m-d\TH:i:s\Z', strtotime($var)) == $var ?  $var : null;
                break;
        }

        throw new Exceptions\ClientException('Unknown data format "' . $this->escapeXML($format) . '" provided.');
    }

    /**
     *
     */
    private function formatXMLFragmentValue($var, $format = 'string')
    {
        switch ($format) {
            case 'bool':
                return $var ? 'true' : 'false';
                break;

            case 'float':
                return number_format($var, 2, '.', '');
                break;

            case 'int':
            case 'string':
                return (string) $var;
                break;

            case 'datetime':
                return date ('Y-m-d\TH:i:s\Z', strtotime($var));
                break;
        }

        throw new Exceptions\ClientException('Unknown data format "' . $this->escapeXML($format) . '" provided.');
    }

    /**
     * Escape special XML characters
     *
     * @param   string  $str
     * @return  string  String with escaped XML characters
     */
    private function escapeXML($str)
    {
        return htmlentities($str, ENT_QUOTES, 'utf-8');
    }

    /**
     * Determines if the passed variable represents a Vleks\SDK complex type
     *
     * @param   mixed   $fieldType
     * @return  bool    True if passed variable is a complex type
     */
    private function isComplexType($fieldType)
    {
        return preg_match('/^Vleks\\\\SDK\\\\/', $fieldType);
    }

    /**
     * Checks whether the passed variable is an associative array
     *
     * @param   mixed   $var
     * @return  bool    True if passed variable is an associative array
     */
    private function isAssociativeArray($var)
    {
        return is_array($var) && array_keys($var) !== range(0, sizeof($var) - 1);
    }

    /**
     * Checks whether the passed variable is a numeric array
     *
     * @param   mixed   $var
     * @return  bool    True if passed variable is a numeric array
     */
    private function isNumericArray($var)
    {
        return is_array($var) && array_keys($var) === range(0, sizeof($var) - 1);
    }

    /**
     * Checks whether the passed variable is a DOMElement
     *
     * @param   mixed   $var
     * @return  bool    True if passed variable is a DOMElement
     */
    private function isDOMElement($var)
    {
        return $var instanceof DOMElement;
    }
}
