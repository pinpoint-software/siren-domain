<?php
namespace Pinpoint\Siren;

use JsonSerializable;

class Field implements JsonSerializable
{
    protected $data;

    public function __construct()
    {
        $this->data = array(
            'name' => null,
            'type' => 'text',
            'value' => null,
            'title' => null,
        );
    }

    public function setName($name)
    {
        $this->data['name'] = $name;
    }

    public function setType(FieldType $type)
    {
        $this->data['type'] = $type;
    }

    public function setValue($value)
    {
        $this->data['value'] = $value;
    }

    public function setTitle($title)
    {
        $this->data['title'] = $title;
    }

    public function jsonSerialize()
    {
        if (!isset($this->data['name'])) {
            throw new RuntimeException(
                sprintf("%s requires name value", __CLASS__)
            );
        }

        if (!isset($this->data['type'])) {
            $this->data['type'] = new FieldType(FieldType::TEXT);
        }

        if (!isset($this->data['type']) && isset($this->data['fields'])) {
            $this->data['type'] = 'application/x-www-form-urlencoded';
        }

        return $this->data;
    }
}
