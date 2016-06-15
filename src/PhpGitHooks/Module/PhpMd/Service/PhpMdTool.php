<?php

namespace PhpGitHooks\Module\PhpMd\Service;

use CommandBus\QueryBus\QueryBus;
use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\Response\PhpFilesResponse;

class PhpMdTool
{
    /**
     * @var QueryBus
     */
    private $queryBus;
    /**
     * @var PhpMdToolExecutor
     */
    private $phpMdToolExecutor;

    /**
     * PhpMdTool constructor.
     *
     * @param QueryBus          $queryBus
     * @param PhpMdToolExecutor $phpMdToolExecutor
     */
    public function __construct(QueryBus $queryBus, PhpMdToolExecutor $phpMdToolExecutor)
    {
        $this->queryBus = $queryBus;
        $this->phpMdToolExecutor = $phpMdToolExecutor;
    }

    /**
     * @param array  $files
     * @param string $errorMessage
     */
    public function execute(array $files, $errorMessage)
    {
        /** @var PhpFilesResponse $phpFilesResponse */
        $phpFilesResponse = $this->queryBus->handle(new PhpFilesExtractorQuery($files));

        if ($phpFilesResponse->getFiles()) {
            $this->phpMdToolExecutor->execute($phpFilesResponse->getFiles(), $errorMessage);
        }
    }
}
