<?php

namespace IPP\Student;

use DOMElement;
use DOMNode;
use IPP\Core\AbstractInterpreter;
use IPP\Core\ReturnCode;
use IPP\Student\Exception\SemanticErrorException;

class Interpreter extends AbstractInterpreter
{
    /** @var array<int> $labelPositions */
    private $labelPositions;

    private static function instruction_sort(DOMElement $a, DOMElement $b): int
    {
        if((int)$a->getAttribute('order') < 0 || (int)$b->getAttribute('order') < 0) {
            throw new SemanticErrorException('ERROR: instruction with negative order');
        }
        return (int)$a->getAttribute('order') - (int)$b->getAttribute('order');
    }
    /**
     * @param array<DOMElement> $instructionElements
     */
    private function firstPass($instructionElements): void
    {
        // Get label positions
        foreach($instructionElements as $key => $el) {
            if($el->getAttribute('opcode') == "LABEL") {
                $label = $el->firstElementChild;
                if(!is_null($label)) {
                    $label = $label->nodeValue;
                }

                $this->labelPositions[$label] = $key;
            }
        }
    }
    /**
     * @param DOMNode[] $instructionElements
     */
    private function secondPass($instructionElements): void
    {

    }

    public function execute(): int
    {
        // TODO: Start your code here
        // Check \IPP\Core\AbstractInterpreter for predefined I/O objects:
        // $dom = $this->source->getDOMDocument();
        // $val = $this->input->readString();
        // $this->stdout->writeString("stdout");
        // $this->stderr->writeString("stderr");

        $context = new Context();
        $dom = $this->source->getDOMDocument();
        $gf = new Frame();

        // Get sorted array of instructions
        $instructionsDOMList = $dom->getElementsByTagName('instruction');
        $instructionElements = iterator_to_array($instructionsDOMList);

        usort($instructionElements, array($this, "instruction_sort"));

        $this->firstPass($instructionElements);
        $this->secondPass($instructionElements);

        return ReturnCode::OK;
    }
}
