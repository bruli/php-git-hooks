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
     * @var PhpUnitProcessorInterface
     */
    private $phpUnitRandomizerProcessor;

    /**
     * PhpUnitTool constructor.
     *
     * @param OutputInterface $output
     * @param PhpUnitProcessorInterface $phpUnitProcessor
     * @param PhpUnitProcessorInterface $phpUnitRandomizerProcessor
     */
    public function __construct(
        OutputInterface $output,
        PhpUnitProcessorInterface $phpUnitProcessor,
        PhpUnitProcessorInterface $phpUnitRandomizerProcessor
    ) {
        $this->output = $output;
        $this->phpUnitProcessor = $phpUnitProcessor;
        $this->phpUnitRandomizerProcessor = $phpUnitRandomizerProcessor;
    }

    /**
     * @param string $randomMode
     * @param string $options
     * @param string $errorMessage
     *
     * @throws PhpUnitViolationException
     */
    public function execute($randomMode, $options, $errorMessage)
    {
        $outputMessage = new PreCommitOutputWriter(self::EXECUTING_MESSAGE);
        $this->output->writeln($outputMessage->getMessage());


        $testResult = $this->executeTool($randomMode, $options);

        if (false === $testResult) {
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));

            throw new PhpUnitViolationException();
        }
    }

    /**
     * @param bool $randomMode
     * @param string $options
     * @return bool
     */
    protected function executeTool($randomMode, $options)
    {
        return true === $randomMode ? $this->phpUnitRandomizerProcessor->process(
            $options
        ) : $this->phpUnitProcessor->process($options);
    }
}
