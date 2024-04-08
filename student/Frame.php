<?php

namespace IPP\Student;

class Frame
{
    /** @var array<Variable> $variables */
    private $variables = array();

    /**
     * @param Variable $var Variable to be inserted
     * @return void
     */
    public function insertVariable(Variable $var): void
    {
        $this->variables[$var->name] = $var;
    }

    /**
    * @param string $name Name of the variable
    * @return Variable|null The variable or null if variable doesnt exist in the frame
    */
    public function getVariable(string $name): ?Variable
    {
        if(!array_key_exists($name, $this->variables)) {
            return null;
        }
        return $this->variables[$name];
    }
}
