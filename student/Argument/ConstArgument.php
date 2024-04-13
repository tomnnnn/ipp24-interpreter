<?php

namespace IPP\Student\Argument;

use IPP\Student\Enums\ArgType;
use IPP\Student\Enums\DataType;

class ConstArgument extends Argument
{
    /** @var DataType $dataType */
    protected $dataType;

    /**
    * @param int|bool|string|null $value
    * @param DataType $dataType
    */
    public function __construct($value, $dataType)
    {
        parent::__construct(ArgType::CONST);

        $this->dataType = $dataType;
        $this->value = $value;
    }

    public function getDataType(): DataType
    {
        return $this->dataType;
    }

    public function getValue(): int|string|bool|null
    {
        switch ($this->dataType) {
            case DataType::INT:
                return (int)$this->value;
            case DataType::STRING:
                return (string)$this->value;
            case DataType::BOOL:
                return $this->value == 'false';
            case DataType::NIL:
                return null;
        }
    }
}
