<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class StringOperationException extends IPPException
{
    public function __construct(string $message = "ERROR: Invalid operation with string")
    {
        parent::__construct($message, ReturnCode::STRING_OPERATION_ERROR);
    }
}
