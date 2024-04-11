<?php

namespace IPP\Student;

class Instruction
{
    public string $opcode;
    public int $argCount;
    /** @var array<Argument> $args*/
    public $args;
}
