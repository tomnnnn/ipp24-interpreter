<?php

namespace IPP\Student;

use DOMDocument;
use DOMElement;
use IPP\Core\AbstractInterpreter;
use IPP\Core\ReturnCode;
use IPP\Student\Argument\ConstArgument;
use IPP\Student\Argument\LabelArgument;
use IPP\Student\Argument\VarArgument;
use IPP\Student\Argument\Argument;
use IPP\Student\Enums\ArgType;
use IPP\Student\Enums\DataType;
use IPP\Student\Exception\SourceFormatException;
use IPP\Student\Factories\InstructionFactory;

class Interpreter extends AbstractInterpreter
{
    private static function instruction_sort(Instruction $a, Instruction $b): int
    {
        return $a->order - $b->order;
    }
    /**
     * @param array<Instruction> $instructions
     * @param InterpreterContext $context
     */
    private function firstPass($instructions, $context): void
    {
        // Get label positions
        foreach($instructions as $key => $instruction) {
            if($instruction->opcode == "LABEL") {
                $label = $instruction->args[0]->getValue();
                $context->labelPositions[$label] = $key;
            }
        }
    }

    /**
     * @param array<Instruction> $instructions
     * @param InstructionFactory $instructionStrategyFactory
     * @param InterpreterContext $context
     */
    private function secondPass($instructions, $instructionStrategyFactory, $context): void
    {
        foreach($instructions as $instruction) {
            $instructionStrategy = $instructionStrategyFactory->createInstructionStrategy($instruction->opcode);

            $context->setInstruction($instructionStrategy);
            $context->executeInstruction($instruction->args);
        }
    }

    /**
     * @param DOMElement $instructionElement
     * @return array<Argument>
     */
    private function getArgs($instructionElement): array
    {
        $args = array();
        $argEl = $instructionElement->firstElementChild;
        while(!is_null($argEl)) {
            $type = ArgType::deserialize($argEl->getAttribute('type'))
                ?? throw new SourceFormatException();
            $value = $argEl->textContent;

            // TODO factory
            switch($type) {
                case ArgType::VAR:
                    $arg = new VarArgument($value);
                    break;
                case ArgType::CONST:
                    $dataType = DataType::tryFrom($argEl->getAttribute('type'))
                        ?? throw new SourceFormatException();
                    $arg = new ConstArgument($value, $dataType);
                    break;
                case ArgType::LABEL:
                    $arg = new LabelArgument($value);
                    break;
            }

            array_push($args, $arg);

            $argEl = $argEl->nextElementSibling;
        }
        return $args;
    }
    /**
    * Converts the given DOM Document to array of Instructions, sorted by order attribute
    * @param DOMDocument $dom
    * @return array<Instruction>
    */
    private function DOMToSortedInstructions($dom): array
    {
        $instructions = array();

        $program = $dom->firstElementChild ?? throw new SourceFormatException();
        $el = $program->firstElementChild;

        while(!is_null($el)) {
            $args = $this->getArgs($el);
            $opcode = $el->getAttribute('opcode');
            $order = $el->getAttribute('order');

            $instruction = new Instruction();
            $instruction->opcode = $opcode;
            $instruction->args = $args;
            $instruction->order = (int)$order;

            array_push($instructions, $instruction);

            $el = $el->nextElementSibling;
        }
        usort($instructions, array($this,"instruction_sort"));
        return $instructions;
    }

    public function execute(): int
    {
        // TODO: Start your code here
        // Check \IPP\Core\AbstractInterpreter for predefined I/O objects:
        // $dom = $this->source->getDOMDocument();
        // $val = $this->input->readString();
        // $this->stdout->writeString("stdout");
        // $this->stderr->writeString("stderr");

        $context = new InterpreterContext($this->stdout, $this->stderr);
        $instructionStrategyFactory = new InstructionFactory();
        $instructions = $this->DOMToSortedInstructions($this->source->getDOMDocument());

        $this->firstPass($instructions, $context);
        $this->secondPass($instructions, $instructionStrategyFactory, $context);

        return ReturnCode::OK;
    }
}
