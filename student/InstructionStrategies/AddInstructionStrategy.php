<?php

namespace IPP\Student\InstructionStrategies;

use IPP\Student\Argument\Argument;
use IPP\Student\Argument\VarArgument;
use IPP\Student\Enums\ArgType;
use IPP\Student\Enums\DataType;
use IPP\Student\Exception\OperandTypeException;
use IPP\Student\Exception\SourceFormatException;

class AddInstructionStrategy extends InstructionStrategyBase
{
    /**
     * @param array<Argument> $args
     * @throws SourceFormatException If the first argument is not a variable
     * @throws OperandTypeException If either of the operands is not an integer
    */
    private function validateArgs($args): void
    {
        // first argument data type validation
        if($args[0]->getArgType() != ArgType::VAR) {
            throw new SourceFormatException("Unexpected argument type");
        }

        // second and third argument data type validation
        if(!$this->validateArgumentDataType($args[1], DataType::INT) ||
            !$this->validateArgumentDataType($args[2], DataType::INT)) {
            throw new OperandTypeException("Unexpected operand type in ADD instruction");
        }
    }

    /**
     * @param array<Argument> $args
     */
    public function execute($args): void
    {
        $this->validateArgs($args);

        /** @var VarArgument @dest */
        $destArg = $args[0];
        $frame = $this->context->getFrameByStringId($destArg->getFrameId());

        /** @var int @op1 */
        $op1 = $this->getSymbolValue($args[1]);
        /** @var int @op2 */
        $op2 = $this->getSymbolValue($args[2]);

        $frame->updateVariable($destArg->getVarId(), $op1 + $op2, DataType::INT);
    }
}
