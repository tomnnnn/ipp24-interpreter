<?php

namespace IPP\Student\Argument;

use IPP\Student\Enums\ArgType;
use IPP\Student\Enums\DataType;

abstract class Argument
{
    /** @var ArgType $argType */
    protected $argType;
    /** @var bool|int|string|null $value */
    protected $value;

    /**
     * @param ArgType $argType
     */
    public function __construct($argType)
    {
        $this->argType = $argType;
    }

    public function getArgType(): ArgType
    {
        return $this->argType;
    }


    public function getValue(): bool|int|string|null
    {
        return $this->value;
    }
}
