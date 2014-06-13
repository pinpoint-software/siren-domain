<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use RuntimeException;

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

    public function setClass($class)
    {
        $this->data['class'] = array();
        $classes = func_get_args();
        foreach ($classes as $class) {
            $this->addClass($class);
        }
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
        if (!isset($this->data['fields'])) {
            $this->data['fields'] = array();
        }

        $this->data['fields'][] = $field;
    }

    public function jsonSerialize()
    {
        if (!isset($this->data['name'])) {
            // This won't actually work
            // You'll get an \Exception with the message
            // "Failed calling Pinpoint\Siren\Action::jsonSerialize()"
            throw new RuntimeException(
                sprintf("%s requires name value", __CLASS__)
            );
        }

        if (!isset($this->data['href'])) {
            // This also won't work, see above
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
