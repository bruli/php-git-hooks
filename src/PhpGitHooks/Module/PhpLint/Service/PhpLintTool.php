<?php

namespace PhpGitHooks\Module\PhpLint\Service;

use CommandBus\QueryBus\QueryBus;
use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\Response\PhpFilesResponse;

class PhpLintTool
{
    /**
     * @var PhpLintToolExecutor
     */
    private $phpLintToolExecutor;
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * PhpLintToolProcessor constructor.
     *
     * @param PhpLintToolExecutor $phpLintToolExecutor
     * @param QueryBus            $queryBus
     */
    public function __construct(PhpLintToolExecutor $phpLintToolExecutor, QueryBus $queryBus)
    {
        $this->phpLintToolExecutor = $phpLintToolExecutor;
        $this->queryBus = $queryBus;
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
            $this->phpLintToolExecutor->execute($phpFilesResponse->getFiles(), $errorMessage);
        }
    }
}
