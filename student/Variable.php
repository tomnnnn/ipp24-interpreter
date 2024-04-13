<?php

namespace IPP\Student;

use IPP\Student\Enums\DataType;

class Variable
{
    public string $name;
    public ?DataType $dataType;
    /** @var bool|int|string|null variable contents*/
    public $contents;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->dataType = null;
        $this->contents = null;
    }
}
