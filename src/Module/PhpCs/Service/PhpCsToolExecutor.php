<?php

namespace Module\PhpCs\Service;

use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\PhpCs\Contract\Exception\PhpCsViolationException;
use Module\PhpCs\Model\PhpCsToolProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpCsToolExecutor
{
    const EXECUTE_MESSAGE = 'Checking code style with PHPCS';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var PhpCsToolProcessorInterface
     */
    private $phpCsToolProcessor;

    /**
     * PhpCsToolExecutor constructor.
     *
     * @param OutputInterface             $output
     * @param PhpCsToolProcessorInterface $phpCsToolProcessor
     */
    public function __construct(OutputInterface $output, PhpCsToolProcessorInterface $phpCsToolProcessor)
    {
        $this->output = $output;
        $this->phpCsToolProcessor = $phpCsToolProcessor;
    }

    /**
     * @param array  $files
     * @param string $standard
     * @param string $errorMessage
     *
     * @throws PhpCsViolationException
     */
    public function execute(array $files, $standard, $errorMessage)
    {
        $outputMessage = new PreCommitOutputWriter(self::EXECUTE_MESSAGE);
        $this->output->write($outputMessage->getMessage());

        $errors = [];
        foreach ($files as $file) {
            $errors[] = $this->phpCsToolProcessor->process($file, $standard);
        }

        $errors = array_filter($errors);

        if ($errors) {
            $this->output->writeln($outputMessage->setError(implode('', $errors)));
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));
            throw new PhpCsViolationException();
        }
        $this->output->writeln($outputMessage->getSuccessfulMessage());
    }
}
