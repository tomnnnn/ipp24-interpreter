<?php

namespace IPP\Student\Enums;

enum ArgType
{
    case VAR;
    case CONST;
    case LABEL;

    public static function deserialize(string $string): ?ArgType
    {
        return match($string) {
            'var' => ArgType::VAR,
            'int','bool', 'string','nil' => ArgType::CONST,
            'label' => ArgType::LABEL,
            default => null
        };
    }
}
