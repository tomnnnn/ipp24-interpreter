<?php

namespace IPP\Student;

use IPP\Core\Interface\OutputWriter;
use IPP\Student\Exception\FrameAccessException;
use IPP\Student\Exception\VariableAccessException;
use IPP\Student\InstructionStrategies\InstructionStrategy;
use IPP\Student\Argument\Argument;
use Ds\Stack;
use UnderflowException;

class InterpreterContext
{
    private InstructionStrategy $instruction;

    /** @var array<int> $labelPositions */
    public $labelPositions;

    /** @var Stack<Frame> $lfStack */
    public Stack $lfStack;
    public Frame $gf;
    public ?Frame $tf;

    /** @var OutputWriter $stdout */
    public $stdout;
    /** @var OutputWriter $stderr */
    public $stderr;

    /**
     * @param OutputWriter $stdout
     * @param OutputWriter $stderr
     */
    public function __construct($stdout, $stderr)
    {
        $this->lfStack = new Stack();
        $this->gf = new Frame();
        $this->tf = null;

        $this->stdout = $stdout;
        $this->stderr = $stderr;
    }

    public function setInstruction(InstructionStrategy $instruction): void
    {
        $this->instruction = $instruction;
        $this->instruction->setContext($this);
    }
    /**
     * @param array<Argument> $args
     */
    public function executeInstruction($args): void
    {
        $this->instruction->execute($args);
    }

    /**
     * Retrieves a frame based on the string identifier.
     * @param string $id
     * @return Frame Returns Frame on success, otherwise throws
     *
     * @throws FrameAccessException if the specified frame does not exist in the current context.
     */
    public function getFrameByStringId($id): Frame
    {
        switch($id) {
            case 'LF':
                try {
                    return $this->lfStack->peek();
                } catch (UnderflowException) {
                    throw new FrameAccessException();
                }
            case 'GF':
                return $this->gf;
            case 'TF':
                return $this->tf ?? throw new FrameAccessException();
            default:
                throw new FrameAccessException();
        }
    }
}
