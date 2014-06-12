<?php
namespace Pinpoint\Siren;

use JsonSerializable;

class Entity implements JsonSerializable
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

    public function addEntity(Relationship $rel, Entity $entity)
    {
        if (!isset($this->data['entity'])) {
            $this->data['entities'] = array();
        }

        $entity->setRelationship($rel);
        $this->data['entities'][] = $entity;
    }

    public function addEntityLink(Relationship $rel, EntityLink $entity)
    {
        if (!isset($this->data['entities'])) {
            $this->data['entities'] = array();
        }

        $entity->setRelationship($rel);
        $this->data['entities'][] = $entity;
    }

    public function addAction(Action $action)
    {
        if (!isset($this->data['actions'])) {
            $this->data['actions'] = array();
        }

        $this->data['actions'][] = $action;
    }

    public function addLink(Relationship $rel, $href, $title = null)
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
