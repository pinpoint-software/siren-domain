<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use RuntimeException;

class Field implements JsonSerializable
{
    protected $data;

    public function __construct($name, FieldType $type = null)
    {
        $this->data = array();

        $this->setName($name);
        if (is_null($type)) {
            $type = new FieldType(FieldType::TEXT);
        }
        $this->setType($type);
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
        return $this->data;
    }
}
