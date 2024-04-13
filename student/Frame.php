<?php

namespace IPP\Student;

use IPP\Student\Enums\DataType;
use IPP\Student\Exception\VariableAccessException;

class Frame
{
    /** @var array<Variable> $variables */
    private $variables = array();

    /**
     * @param Variable $var Variable to be inserted
     * @return bool True if the variable has been inserted, false if it already exists
     */
    public function insertVariable(Variable $var): bool
    {
        if(!array_key_exists($var->name, $this->variables)) {
            $this->variables[$var->name] = $var;
            return true;
        }

        return false;
    }

    /**
    * @param string $name Name of the variable
    * @return Variable Returns the specified variable, otherwise throws.
    *
    * @throws VariableAccessException If the specified variable does not exist in the frame
    */
    public function getVariable(string $name): Variable
    {
        if(!array_key_exists($name, $this->variables)) {
            throw new VariableAccessException();
        }
        return $this->variables[$name];
    }
    /**
     * Updates specified variable.
     * @param int|bool|string $value
     * @param DataType $dataType
     *
     * @throws VariableAccessException If the variable does not exist
     */
    public function updateVariable(string $name, $value, $dataType): void
    {
        if(array_key_exists($name, $this->variables)) {
            $this->variables[$name]->contents = $value;
            $this->variables[$name]->dataType = $dataType;
        } else {
            throw new VariableAccessException();
        }
    }
}
