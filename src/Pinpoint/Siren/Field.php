<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use RuntimeException;

class Field implements JsonSerializable
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
            // This won't actually work
            // You'll get an \Exception with the message
            // "Failed calling Pinpoint\Siren\Field::jsonSerialize()"
            throw new RuntimeException(
                sprintf("%s requires name value", __CLASS__)
            );
        }

        if (!isset($this->data['type'])) {
            $this->data['type'] = new FieldType(FieldType::TEXT);
        }

        return $this->data;
    }
}
