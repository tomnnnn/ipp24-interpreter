<?php

namespace IPP\Student;

use IPP\Student\Enums\ArgType;

class Argument
{
    /** @var ArgType $type */
    public $type;
    /** @var mixed $value */
    public $value;

    /**
    * @param ArgType $type
    * @param mixed $value
    */
    public function __construct($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }
}
