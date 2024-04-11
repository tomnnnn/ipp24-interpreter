<?php

namespace IPP\Student;

use IPP\Student\InstructionStrategies\InstructionStrategy;

class InterpreterContext
{
    private InstructionStrategy $instruction;
    /** @var array<int> $labelPositions */
    public $labelPositions;

    public function setInstruction(InstructionStrategy $instruction): void
    {
        $this->instruction = $instruction;
        $this->instruction->setContext($this);
    }
    /**
     * @param array<Argument> $args
     */
    public function executeInstruction($args): void
    {
        $this->instruction->execute($args);
    }
}
