<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use RuntimeException;

class EntityLink implements JsonSerializable
{
    protected $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setRel(Rel $rel)
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
        if (!isset($this->data['rel'])) {
            throw new RuntimeException(
                sprintf(
                    "%s requires rel value",
                    __CLASS__
                )
            );
        }

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
