<?php

namespace Module\JsonLint\Service;

use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\JsonLint\Contract\Exception\JsonLintViolationsException;
use Module\JsonLint\Model\JsonLintProcessorInterface;
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
     * @param array  $files
     * @param string $errorMessage
     *
     * @throws JsonLintViolationsException
     */
    public function execute(array $files, $errorMessage)
    {
        $outputMessage = new PreCommitOutputWriter(self::CHECKING_MESSAGE);
        $this->output->write($outputMessage->getMessage());

        $errors = [];
        foreach ($files as $file) {
            $errors[] = $this->jsonLintProcessor->process($file);
        }

        $errors = array_filter($errors);

        if ($errors) {
            $this->output->writeln($outputMessage->setError(implode('', $errors)));
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));
            throw new JsonLintViolationsException(implode('', $errors));
        }

        $this->output->writeln($outputMessage->getSuccessfulMessage());
    }
}
