<?php

namespace IPP\Student\Enums;

enum ArgType: string
{
    case VAR = 'var';
    case INT = 'int';
    case STRING = 'string';
    case BOOL = 'bool';
    case NIL = 'nil';
    case LABEL = 'label';
}
