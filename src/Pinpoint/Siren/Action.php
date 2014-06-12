<?php
namespace Pinpoint\Siren;

use JsonSerializable;

class Action implements JsonSerializable
{
    protected $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setName($name)
    {
        $this->data['name'] = $name;
    }

    public function addClass($class)
    {
        if (!isset($this->data['class'])) {
            $this->data['class'] = array();
        }

        $this->data['class'][] = $class;
    }

    public function setMethod(Method $method)
    {
        $this->data['method'] = $method;
    }

    public function setHref($href)
    {
        $this->data['href'] = $href;
    }

    public function setTitle($title)
    {
        $this->data['title'] = $title;
    }

    public function setType($type)
    {
        $this->data['type'] = $type;
    }

    public function addField(Field $field)
    {
        if (!isset($this->data['field'])) {
            $this->data['field'] = array();
        }

        $this->data['field'][] = $field;
    }

    public function jsonSerialize()
    {
        if (!isset($this->data['name'])) {
            throw new RuntimeException(
                sprintf("%s requires name value", __CLASS__)
            );
        }

        if (!isset($this->data['href'])) {
            throw new RuntimeException(
                sprintf("%s requires href value", __CLASS__)
            );
        }

        if (!isset($this->data['type']) && isset($this->data['fields'])) {
            $this->data['type'] = 'application/x-www-form-urlencoded';
        }

        return $this->data;
    }
}
