<?php

namespace Module\PhpMd\Service;

use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\PhpMd\Contract\Exception\PhpMdViolationsException;
use Module\PhpMd\Model\PhpMdToolProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpMdToolExecutor
{
    const CHECKING_MESSAGE = 'Checking code mess with PHPMD';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var PhpMdToolProcessorInterface
     */
    private $phpMdToolProcessor;

    /**
     * PhpMdToolExecutor constructor.
     *
     * @param OutputInterface             $output
     * @param PhpMdToolProcessorInterface $phpMdToolProcessor
     */
    public function __construct(OutputInterface $output, PhpMdToolProcessorInterface $phpMdToolProcessor)
    {
        $this->output = $output;
        $this->phpMdToolProcessor = $phpMdToolProcessor;
    }

    /**
     * @param array  $files
     * @param string $errorMessage
     *
     * @throws PhpMdViolationsException
     */
    public function execute(array  $files, $errorMessage)
    {
        $outputMessage = new PreCommitOutputWriter(self::CHECKING_MESSAGE);
        $this->output->write($outputMessage->getMessage());

        $errors = [];
        foreach ($files as $file) {
            $errors[] = $this->phpMdToolProcessor->process($file);
        }

        $errors = array_filter($errors);

        if ($errors) {
            $outputText = $outputMessage->setError(implode('', $errors));
            $this->output->writeln($outputText);
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));
            throw new PhpMdViolationsException();
        }

        $this->output->writeln($outputMessage->getSuccessfulMessage());
    }
}
