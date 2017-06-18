<?php

namespace PhpGitHooks\Module\JsonLint\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use Bruli\EventBusBundle\QueryBus\QueryBus;
use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractor;
use PhpGitHooks\Module\JsonLint\Service\JsonLintToolExecutor;

class JsonLintToolHandler implements CommandHandlerInterface
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
    private function execute(array $files, $errorMessage)
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

    /**
     * @param CommandInterface|JsonLintTool $command
     */
    public function handle(CommandInterface $command)
    {
        $this->execute($command->getFiles(), $command->getErrorMessage());
    }
}
