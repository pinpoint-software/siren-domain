<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use RuntimeException;

class Action implements JsonSerializable
{
    protected $data;

    public function __construct($name, $href, Method $method = null)
    {
        $this->data = array();
        $this->setName($name);
        $this->setHref($href);
        if (is_null($method)) {
            $method = new Method(Method::GET);
        }
        $this->setMethod($method);
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
        if (!isset($this->data['type']) && isset($this->data['fields'])) {
            $this->data['type'] = 'application/x-www-form-urlencoded';
        }

        return $this->data;
    }
}
