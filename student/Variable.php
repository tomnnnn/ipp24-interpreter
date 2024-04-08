<?php

namespace IPP\Student;

use IPP\Student\Enums\VariableType;

class Variable
{
    public string $name;
    public VariableType $type;
    /** @var mixed variable contents*/
    public $contents;

    /**
     * Variable constructor.
     * @param string $name
     * @param mixed $contents
     */
    public function __construct(string $name, $contents)
    {
        $this->name = $name;
        $this->contents = $contents;
    }

    public function test(int $a, string $b): int
    {
        return 0;
    }
}
