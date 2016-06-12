<?php

namespace Module\PhpCs\Service;

use Infrastructure\QueryBus\QueryBus;
use Module\Files\Contract\Query\PhpFilesExtractorQuery;
use Module\Files\Contract\Response\PhpFilesResponse;

class PhpCsTool
{
    /**
     * @var PhpCsToolExecutor
     */
    private $phpCsToolExecutor;
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * PhpCsToolProcessor constructor.
     *
     * @param PhpCsToolExecutor $phpCsToolExecutor
     * @param QueryBus          $queryBus
     */
    public function __construct(PhpCsToolExecutor $phpCsToolExecutor, QueryBus $queryBus)
    {
        $this->phpCsToolExecutor = $phpCsToolExecutor;
        $this->queryBus = $queryBus;
    }

    /**
     * @param array  $files
     * @param string $standard
     * @param string $errorMessage
     */
    public function execute(array $files, $standard, $errorMessage)
    {
        /** @var PhpFilesResponse $phpFilesResponse */
        $phpFilesResponse = $this->queryBus->handle(new PhpFilesExtractorQuery($files));

        if ($phpFilesResponse->getFiles()) {
            $this->phpCsToolExecutor->execute($phpFilesResponse->getFiles(), $standard, $errorMessage);
        }
    }
}
