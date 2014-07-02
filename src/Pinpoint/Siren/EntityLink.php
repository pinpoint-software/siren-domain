<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use RuntimeException;

class EntityLink implements JsonSerializable
{
    protected $data;

    public function __construct($href)
    {
        $this->data = array();

        $this->setHref($href);
    }

    public function setRel(Rel $rel)
    {
        $this->data['rel'] = $rel;
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

    public function setHref($href)
    {
        $this->data['href'] = $href;
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
