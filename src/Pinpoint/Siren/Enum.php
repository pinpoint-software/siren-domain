<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use ReflectionClass;
use UnexpectedValueException;

class Enum implements JsonSerializable
{
    const __DEFAULT = null;

    protected $value;

    public function __construct($initialValue = null)
    {
        $constList = $this->getConstList();
        if (is_null($initialValue)) {
            $this->value = $this::__DEFAULT;
        } elseif (false === array_search($initialValue, $constList)) {
            throw new UnexpectedValueException('Value not a const in enum ' . get_class($this));
        } else {
            $this->value = $initialValue;
        }
    }

    public function getConstList($includeDefault = false)
    {
        $refl = new ReflectionClass($this);
        $constList = $refl->getConstants();
        if (false === $includeDefault) {
            unset($constList['__DEFAULT']);
        }
        return $constList;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
