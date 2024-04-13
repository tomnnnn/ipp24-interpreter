<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class OperandValueException extends IPPException
{
    public function __construct(string $message = "Invalid operand value")
    {
        parent::__construct($message, code: ReturnCode::OPERAND_VALUE_ERROR, showTrace: false);
    }
}
