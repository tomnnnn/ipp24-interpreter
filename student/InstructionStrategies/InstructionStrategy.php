<?php

namespace IPP\Student\InstructionStrategies;

use IPP\Student\InterpreterContext;
use IPP\Student\Argument;

interface InstructionStrategy
{
    /**
     * @param InterpreterContext $context
     * @return void
     */
    public function setContext($context): void;

    /**
    * @param array<Argument> $args
    */
    public function execute($args): void;
}
