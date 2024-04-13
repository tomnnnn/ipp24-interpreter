<?php

namespace IPP\Student\Argument;

use IPP\Student\Enums\ArgType;

class LabelArgument extends Argument
{
    /** @var string $value */
    public $value;

    /** @param string $value */
    public function __construct($value)
    {
        parent::__construct(ArgType::LABEL);
        $this->value = $value;
    }
    public function getValue(): string
    {
        return $this->value;
    }
}
