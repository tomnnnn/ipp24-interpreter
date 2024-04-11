<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class SourceFormatException extends IPPException
{
    public function __construct(string $message = "Invalid XML source structure")
    {
        parent::__construct($message, ReturnCode::INVALID_SOURCE_STRUCTURE);
    }
}
