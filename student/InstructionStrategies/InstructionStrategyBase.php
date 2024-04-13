<?php

namespace IPP\Student\InstructionStrategies;

use IPP\Core\Exception\InternalErrorException;
use IPP\Student\Argument\Argument;
use IPP\Student\Argument\VarArgument;
use IPP\Student\Argument\ConstArgument;
use IPP\Student\Enums\ArgType;
use IPP\Student\Enums\DataType;
use IPP\Student\Exception\FrameAccessException;
use IPP\Student\Exception\ValueException;
use IPP\Student\Exception\VariableAccessException;
use IPP\Student\InterpreterContext;

abstract class InstructionStrategyBase implements InstructionStrategy
{
    /** @var InterpreterContext $context */
    protected $context;

    public function setContext($context): void
    {
        $this->context = $context;
    }

    /**
     * Validates the data type of the value of either a constant or a value that a variable holds in a given argument.
     * @param Argument $arg
     * @param DataType $expectedType
     *
     * @throws FrameAccessException When the argument specifies variable with non existent frame.
     * @throws VariableAccessException When the argument specifies variable that does not exist in the specified frame.
     * @throws ValueException If a variable specified by the argument is not initialized.
     *
     * @return bool True if the argument has expected data type. Otherwise False.
     */
    protected function validateArgumentDataType($arg, $expectedType): bool
    {
        if($arg->getArgType() == ArgType::VAR) {
            /** @var VarArgument $varArg */
            $varArg = $arg;

            // get the specified variable
            $frame = $this->context->getFrameByStringId($varArg->getFrameId());
            $var = $frame->getVariable($varArg->getVarId());

            return ($var->dataType ?? throw new ValueException()) == $expectedType;
        } elseif ($arg->getArgType() == ArgType::CONST) {
            /** @var ConstArgument $constArg */
            $constArg = $arg;
            return $constArg->getDataType() == $expectedType;
        } else {
            // label argument does not have data type
            return false;
        }
    }

    /**
    * Retrieves the data value of the constant or variable argument. The argument type must be validated beforehand.
    * @param Argument $symb
    */
    protected function getSymbolValue($symb): bool|int|string|null
    {
        if($symb->getArgType() == ArgType::CONST) {
            return $symb->getValue();
        } elseif($symb->getArgType() == ArgType::VAR) {
            /** @var VarArgument $varArg */
            $varArg = $symb;

            // get the specified variable
            $frame = $this->context->getFrameByStringId($varArg->getFrameId());
            $var = $frame->getVariable($varArg->getVarId());

            return $var->contents;
        } else {
            throw new InternalErrorException("Tried to retrieve a value from a non symbol argument");
        }
    }
}
