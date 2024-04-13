<?php

namespace IPP\Student;

use IPP\Student\Argument\Argument;

class Instruction
{
    public string $opcode;
    public int $argCount;
    /** @var array<Argument> $args*/
    public $args;
    public int $order;
}
