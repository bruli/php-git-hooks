<?php

namespace PhpGitHooks\Module\JsonLint\Service;

use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\JsonLint\Contract\Exception\JsonLintViolationsException;
use PhpGitHooks\Module\JsonLint\Model\JsonLintProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JsonLintToolExecutor
{
    const CHECKING_MESSAGE = 'Checking json files';
    /**
     * @var JsonLintProcessorInterface
     */
    private $jsonLintProcessor;
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * JsonLintToolExecutor constructor.
     *
     * @param JsonLintProcessorInterface $jsonLintProcessor
     * @param OutputInterface            $output
     */
    public function __construct(JsonLintProcessorInterface $jsonLintProcessor, OutputInterface $output)
    {
        $this->jsonLintProcessor = $jsonLintProcessor;
        $this->output = $output;
    }

    /**
     * @param array $files
     * @param string $errorMessage
     * @param bool $enableFaces
     *
     * @throws JsonLintViolationsException
     */
    public function execute(array $files, $errorMessage, $enableFaces)
    {
        $outputMessage = new PreCommitOutputWriter(self::CHECKING_MESSAGE);
        $this->output->write($outputMessage->getMessage());

        $errors = [];
        foreach ($files as $file) {
            $errors[] = $this->jsonLintProcessor->process($file);
        }

        $errors = array_filter($errors);

        if (!empty($errors)) {
            $this->output->writeln($outputMessage->getFailMessage());
            $this->output->writeln($outputMessage->setError(implode('', $errors)));
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage, $enableFaces));
            throw new JsonLintViolationsException(implode('', $errors));
        }

        $this->output->writeln($outputMessage->getSuccessfulMessage());
    }
}
