<?php

namespace IPP\Student\InstructionStrategies;

use IPP\Student\Argument\VarArgument;
use IPP\Student\Exception\SemanticErrorException;
use IPP\Student\Variable;

class DefvarInstructionStrategy extends InstructionStrategyBase
{
    public function execute($args): void
    {
        // expecting valid variable argument
        /** @var VarArgument $varArg */
        $varArg = $args[0];
        $frame = $this->context->getFrameByStringId($varArg->getFrameId());
        $var = new Variable(name: $varArg->getVarId());

        if(!$frame->insertVariable($var)) {
            throw new SemanticErrorException("Variable redefinition");
        }
    }
}
