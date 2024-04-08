<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class OperandValueException extends IPPException
{
    public function __construct(string $message = "ERROR: Invalid operand value")
    {
        parent::__construct($message, code: ReturnCode::OPERAND_VALUE_ERROR);
    }
}
