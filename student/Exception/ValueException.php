<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class ValueException extends IPPException
{
    public function __construct(string $message="ERROR: Missing value") {
        parent::__construct($message, ReturnCode::VALUE_ERROR)
    }
}
