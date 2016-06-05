<?php

namespace Module\JsonLint\Service;

use Module\Files\Contract\Query\JsonFilesExtractorQuery;
use Module\Files\Contract\QueryHandler\JsonFilesExtractorQueryHandler;
use Symfony\Component\Console\Output\OutputInterface;

class JsonLintTool
{
    const CHECKING_MESSAGE = '<info>Checking json files....... </info>';
    const OK = '<comment>0K</comment>';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var JsonLintToolExecutor
     */
    private $jsonLintToolExecutor;
    /**
     * @var JsonFilesExtractorQueryHandler
     */
    private $jsonFilesExtractorQueryHandler;

    /**
     * JsonLintTool constructor.
     *
     * @param OutputInterface                $output
     * @param JsonLintToolExecutor           $jsonLintToolExecutor
     * @param JsonFilesExtractorQueryHandler $jsonFilesExtractorQueryHandler
     */
    public function __construct(
        OutputInterface $output,
        JsonLintToolExecutor $jsonLintToolExecutor,
        JsonFilesExtractorQueryHandler $jsonFilesExtractorQueryHandler
    ) {
        $this->output = $output;
        $this->jsonLintToolExecutor = $jsonLintToolExecutor;
        $this->jsonFilesExtractorQueryHandler = $jsonFilesExtractorQueryHandler;
    }

    /**
     * @param array  $files
     * @param string $errorMessage
     */
    public function execute(array $files, $errorMessage)
    {
        $jsonFiles = $this->jsonFilesExtractorQueryHandler->handle(new JsonFilesExtractorQuery($files));

        if (true === $this->jsonFilesExists($jsonFiles->getFiles())) {
            $this->output->write(self::CHECKING_MESSAGE);
            $this->jsonLintToolExecutor->execute($jsonFiles->getFiles(), $errorMessage);
            $this->output->writeln(self::OK);
        }
    }

    /**
     * @param array $files
     *
     * @return bool
     */
    private function jsonFilesExists(array $files)
    {
        return 0 < count($files);
    }
}
