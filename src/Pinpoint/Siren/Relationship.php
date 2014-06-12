<?php
namespace Pinpoint\Siren;

use JsonSerializable;
use InvalidArgumentException;

class Relationship implements JsonSerializable
{
    protected $rel;

    public function __construct($rel)
    {
        $this->rel = func_get_args();
        foreach ($this->rel as $rel) {
            if (!is_string($rel)) {
                throw new InvalidArgumentException(
                    sprintf(
                        "Invalid Argument %s:%s",
                        __CLASS__,
                        __METHOD__
                    )
                );
            }
        }
    }

    public function jsonSerialize()
    {
        return $this->rel;
    }
}
