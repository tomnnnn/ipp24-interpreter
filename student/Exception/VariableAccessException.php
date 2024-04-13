<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class VariableAccessException extends IPPException
{
    public function __construct(string $message = "Access to non-existent variable")
    {
        parent::__construct($message, ReturnCode::VARIABLE_ACCESS_ERROR, showTrace: false);
    }
}
