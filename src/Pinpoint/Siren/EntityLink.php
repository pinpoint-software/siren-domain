<?php
namespace Pinpoint\Sirens;

use JsonSerializable;

class EntityLink implements JsonSerializable
{
    protected $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setRelationship(Relationship $rel)
    {
        $this->data['rel'] = $rel;
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
        if (!isset($this->data['href'])) {
            throw new RuntimeException(
                sprintf(
                    "%s requires href value",
                    __CLASS__
                )
            );
        }

        return $this->data;
    }
}
