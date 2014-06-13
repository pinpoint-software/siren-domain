<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use InvalidArgumentException;

class Entity implements JsonSerializable
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

        if (is_string($class)) {
            $this->data['class'][] = $class;
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid Argument %s:%s",
                    __CLASS__,
                    __METHOD__
                )
            );
        }
    }

    public function setProperty($key, $value)
    {
        if (!isset($this->data['properties'])) {
            $this->data['properties'] = array();
        }

        if (is_string($key) && is_scalar($value)) {
            $this->data['properties'][$key] = $value;
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid Argument %s:%s",
                    __CLASS__,
                    __METHOD__
                )
            );
        }
    }

    public function addEntity(Rel $rel, Entity $entity)
    {
        if (!isset($this->data['entity'])) {
            $this->data['entities'] = array();
        }

        $entity->setRel($rel);
        $this->data['entities'][] = $entity;
    }

    public function addEntityLink(Rel $rel, EntityLink $entity)
    {
        if (!isset($this->data['entities'])) {
            $this->data['entities'] = array();
        }

        $entity->setRel($rel);
        $this->data['entities'][] = $entity;
    }

    public function addAction(Action $action)
    {
        if (!isset($this->data['actions'])) {
            $this->data['actions'] = array();
        }

        $this->data['actions'][] = $action;
    }

    public function addLink(Rel $rel, $href, $title = null)
    {
        if (!isset($this->data['link'])) {
            $this->data['links'] = array();
        }

        $link = array('rel' => $rel, 'href' => $href);
        if (isset($title)) {
            $link['title'] = $title;
        }

        $this->data['links'][] = $link;
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
