<?php

namespace PhpGitHooks\Module\JsonLint\Service;

use Bruli\EventBusBundle\QueryBus\QueryBus;
use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractor;

class JsonLintTool
{
    /**
     * @var JsonLintToolExecutor
     */
    private $jsonLintToolExecutor;
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * JsonLintTool constructor.
     *
     * @param JsonLintToolExecutor $jsonLintToolExecutor
     * @param QueryBus             $queryBus
     */
    public function __construct(
        JsonLintToolExecutor $jsonLintToolExecutor,
        QueryBus $queryBus
    ) {
        $this->jsonLintToolExecutor = $jsonLintToolExecutor;
        $this->queryBus = $queryBus;
    }

    /**
     * @param array  $files
     * @param string $errorMessage
     */
    public function execute(array $files, $errorMessage)
    {
        $jsonFilesResponse = $this->queryBus->handle(new JsonFilesExtractor($files));

        if (true === $this->jsonFilesExists($jsonFilesResponse->getFiles())) {
            $this->jsonLintToolExecutor->execute($jsonFilesResponse->getFiles(), $errorMessage);
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
