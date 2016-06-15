<?php

namespace Module\PhpUnit\Service;

use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\PhpUnit\Contract\Exception\PhpUnitViolationException;
use Module\PhpUnit\Model\PhpUnitProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpUnitToolExecutor
{
    const EXECUTING_MESSAGE = 'Running unit tests';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var PhpUnitProcessorInterface
     */
    private $phpUnitProcessor;

    /**
     * PhpUnitTool constructor.
     *
     * @param OutputInterface           $output
     * @param PhpUnitProcessorInterface $phpUnitProcessor
     */
    public function __construct(OutputInterface $output, PhpUnitProcessorInterface $phpUnitProcessor)
    {
        $this->output = $output;
        $this->phpUnitProcessor = $phpUnitProcessor;
    }

    /**
     * @param string $options
     * @param string $errorMessage
     *
     * @throws PhpUnitViolationException
     */
    public function execute($options, $errorMessage)
    {
        $outputMessage = new PreCommitOutputWriter(self::EXECUTING_MESSAGE);
        $this->output->writeln($outputMessage->getMessage());

        $testResult = $this->phpUnitProcessor->process($options);

        if (false === $testResult) {
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));

            throw new PhpUnitViolationException();
        }
    }
}
