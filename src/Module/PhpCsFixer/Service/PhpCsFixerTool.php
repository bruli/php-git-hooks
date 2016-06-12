<?php

namespace Module\PhpCsFixer\Service;

use Infrastructure\QueryBus\QueryBus;
use Module\Files\Contract\Query\PhpFilesExtractorQuery;
use Module\Files\Contract\Response\PhpFilesResponse;

class PhpCsFixerTool
{
    /**
     * @var QueryBus
     */
    private $queryBus;
    /**
     * @var PhpCsFixerToolExecutor
     */
    private $phpCsFixerToolExecutor;

    /**
     * PhpCsFixerTool constructor.
     *
     * @param QueryBus $queryBus
     * @param PhpCsFixerToolExecutor $phpCsFixerToolExecutor
     */
    public function __construct(QueryBus $queryBus, PhpCsFixerToolExecutor $phpCsFixerToolExecutor)
    {
        $this->queryBus = $queryBus;
        $this->phpCsFixerToolExecutor = $phpCsFixerToolExecutor;
    }

    /**
     * @param array $files
     * @param bool $psr0
     * @param bool $psr1
     * @param bool $psr2
     * @param bool $symfony
     * @param string $errorMessage
     */
    public function execute(array $files, $psr0, $psr1, $psr2, $symfony, $errorMessage)
    {
        /** @var PhpFilesResponse $phpFilesResponse */
        $phpFilesResponse = $this->queryBus->handle(new PhpFilesExtractorQuery($files));

        if ($phpFilesResponse->getFiles()) {
            $this->phpCsFixerToolExecutor->execute(
                $phpFilesResponse->getFiles(),
                $psr0,
                $psr1,
                $psr2,
                $symfony,
                $errorMessage
            );
        }
    }
}
