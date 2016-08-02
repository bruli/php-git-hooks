<?php

namespace PhpGitHooks\Module\PhpCsFixer\Service;

use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpCsFixer\Contract\Exception\PhpCsFixerViolationsException;
use PhpGitHooks\Module\PhpCsFixer\Model\PhpCsFixerToolProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpCsFixerTool
{
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var PhpCsFixerToolProcessorInterface
     */
    private $phpCsFixerToolProcessor;

    /**
     * PhpCsFixerTool constructor.
     *
     * @param OutputInterface                  $output
     * @param PhpCsFixerToolProcessorInterface $phpCsFixerToolProcessor
     */
    public function __construct(OutputInterface $output, PhpCsFixerToolProcessorInterface $phpCsFixerToolProcessor)
    {
        $this->output = $output;
        $this->phpCsFixerToolProcessor = $phpCsFixerToolProcessor;
    }

    /**
     * @param array  $files
     * @param bool   $psr0
     * @param bool   $psr1
     * @param bool   $psr2
     * @param bool   $symfony
     * @param string $options
     * @param string $errorMessage
     */
    public function execute(array $files, $psr0, $psr1, $psr2, $symfony, $options, $errorMessage)
    {
        if (true === $psr0) {
            $this->executeTool($files, 'PSR0', $options, $errorMessage);
        }

        if (true === $psr1) {
            $this->executeTool($files, 'PSR1', $options, $errorMessage);
        }

        if (true === $psr2) {
            $this->executeTool($files, 'PSR2', $options, $errorMessage);
        }

        if (true === $symfony) {
            $this->executeTool($files, 'SYMFONY', $options, $errorMessage);
        }
    }

    /**
     * @param array  $files
     * @param string $level
     * @param string $options
     * @param string $errorMessage
     *
     * @throws PhpCsFixerViolationsException
     */
    private function executeTool(array $files, $level, $options, $errorMessage)
    {
        $outputMessage = new PreCommitOutputWriter(sprintf('Checking %s code style with PHP-CS-FIXER', $level));
        $this->output->write($outputMessage->getMessage());

        $errors = [];
        foreach ($files as $file) {
            $errors[] = $this->phpCsFixerToolProcessor->process($file, $level, $options);
        }

        $errors = array_filter($errors);

        if (!empty($errors)) {
            $this->output->writeln($outputMessage->getFailMessage());
            $errorsText = $outputMessage->setError(implode('', $errors));
            $this->output->writeln($errorsText);
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));
            throw  new PhpCsFixerViolationsException();
        }

        $this->output->writeln($outputMessage->getSuccessfulMessage());
    }
}
