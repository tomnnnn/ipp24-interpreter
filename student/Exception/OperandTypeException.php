<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class OperandTypeException extends IPPException
{
    public function __construct(string $message = "Unexpected operand type")
    {
        parent::__construct($message, ReturnCode::OPERAND_TYPE_ERROR, showTrace: false);
    }
}
