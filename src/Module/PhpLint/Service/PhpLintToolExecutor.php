<?php

namespace Module\PhpLint\Service;

use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\PhpLint\Contract\Exception\PhpLintException;
use Module\PhpLint\Model\PhpLintToolProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpLintToolExecutor
{
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
     * @throws PhpLintException
     */
    public function execute(array $files, $errorMessage)
    {
        unset($files[0]);
        $errors = [];
        foreach ($files as $file) {
            $errors[] = $this->phpLintTool->process($file);
        }

        $errors = array_filter($errors);

        if ($errors) {
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));

            throw new PhpLintException();
        }
    }
}
