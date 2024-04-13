<?php

namespace IPP\Student\Exception;

use IPP\Core\Exception\IPPException;
use IPP\Core\ReturnCode;

class FrameAccessException extends IPPException
{
    public function __construct(string $message = "Access to non-existent frame")
    {
        parent::__construct($message, ReturnCode::FRAME_ACCESS_ERROR, showTrace: false);
    }
}
