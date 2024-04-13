<?php

namespace IPP\Student\Factories;

use IPP\Student\Exception\SemanticErrorException;
use IPP\Student\InstructionStrategies\AddInstructionStrategy;
use IPP\Student\InstructionStrategies\DefvarInstructionStrategy;
use IPP\Student\InstructionStrategies\InstructionStrategy;
use IPP\Student\InstructionStrategies\WriteInstructionStrategy;

class InstructionFactory
{
    public function createInstructionStrategy(string $opcode): InstructionStrategy
    {
        return match($opcode) {
            'ADD' => new AddInstructionStrategy(),
            'DEFVAR' => new DefvarInstructionStrategy(),
            'WRITE' => new WriteInstructionStrategy(),
            default => throw new SemanticErrorException(("Unknown instruction encountered"))
        };
    }
}
