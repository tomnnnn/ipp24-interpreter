<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class SemanticErrorException extends IPPException
{
    public function __construct(string $message)
    {
        parent::__construct($message, code: ReturnCode::SEMANTIC_ERROR);
    }
}
