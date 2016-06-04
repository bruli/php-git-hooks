<?php

namespace Module\Git\Contract\Command;

use Composer\IO\IOInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PreCommitToolCommand
{
    /**
     * @var OutputInterface
     */
    private $outputInterface;

    /**
     * PreCommitToolCommand constructor.
     *
     * @param OutputInterface $outputInterface
     */
    public function __construct(OutputInterface $outputInterface)
    {
        $this->outputInterface = $outputInterface;
    }

    /**
     * @return OutputInterface
     */
    public function getOutputInterface()
    {
        return $this->outputInterface;
    }
}
