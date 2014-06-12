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
        } elseif (isset($constList[$initialValue])) {
            $this->value = $initialValue;
        } else {
            throw new UnexpectedValueException('Value not a const in enum ' . get_class($this));
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
