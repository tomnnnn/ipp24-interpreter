<?php

namespace IPP\Student\InstructionStrategies;

use IPP\Student\Argument\ConstArgument;
use IPP\Student\Argument\VarArgument;
use IPP\Student\Enums\ArgType;
use IPP\Student\Enums\DataType;

class WriteInstructionStrategy extends InstructionStrategyBase
{
    public function execute($args): void
    {
        $string = "";

        if($args[0]->getArgType() == ArgType::VAR) {
            /** @var VarArgument $varArg */
            $varArg = $args[0];
            $frame = $this->context->getFrameByStringId($varArg->getFrameId());
            $var = $frame->getVariable($varArg->getVarId());

            // TODO getters setters
            $dataType = $var->dataType;
            $value = $var->contents;
        } else {
            /** @var ConstArgument $constArg */
            $constArg = $args[0];
            $dataType = $constArg->getDataType();
            $value = $constArg->getValue();
        }

        if($dataType == DataType::NIL) {
            /** @var string $string */
            $string = "";
        } elseif($dataType == DataType::BOOL) {
            /** @var bool $boolValue */
            $boolValue = $value;

            /** @var string $string */
            $string = $boolValue ? 'true' : 'false';
        } else {
            /** @var string $string */
            $string = $value;
        }
        print($string);
    }
}
