<?php

namespace Module\PhpLint\Service;

use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\PhpLint\Contract\Exception\PhpLintViolationsException;
use Module\PhpLint\Model\PhpLintToolProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpLintToolExecutor
{
    const RUNNING_PHPLINT = 'Running PHPLINT';
    /**
     * @var PhpLintToolProcessorInterface
     */
    private $phpLintTool;
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * PhpLintToolExecutor constructor.
     *
     * @param PhpLintToolProcessorInterface $phpLintTool
     * @param OutputInterface               $output
     */
    public function __construct(PhpLintToolProcessorInterface $phpLintTool, OutputInterface $output)
    {
        $this->phpLintTool = $phpLintTool;
        $this->output = $output;
    }

    /**
     * @param array $files
     * @param $errorMessage
     *
     * @throws PhpLintViolationsException
     */
    public function execute(array $files, $errorMessage)
    {
        $outputMessage = new PreCommitOutputWriter(self::RUNNING_PHPLINT);
        $this->output->write($outputMessage->getMessage());

        $errors = [];
        foreach ($files as $file) {
            $errors[] = $this->phpLintTool->process($file);
        }

        $errors = array_filter($errors);

        if ($errors) {
            $this->output->writeln($outputMessage->getFailMessage());
            $this->output->writeln($outputMessage->setError(implode('', $errors)));
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));

            throw new PhpLintViolationsException();
        }

        $this->output->writeln($outputMessage->getSuccessfulMessage());
    }
}
