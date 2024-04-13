<?php

namespace IPP\Student\Argument;

use IPP\Student\Enums\ArgType;

class VarArgument extends Argument
{
    /** @var string $value */
    protected $value;

    /** @param string $value */
    public function __construct($value)
    {
        parent::__construct(ArgType::VAR);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /** @return string */
    public function getFrameId(): string
    {
        return explode('@', $this->value)[0];
    }

    /** @return string */
    public function getVarId(): string
    {
        return explode('@', $this->value)[1];
    }
}
