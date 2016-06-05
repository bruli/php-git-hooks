<?php

namespace Module\PhpLint\Service;

use Module\Shared\Service\PhpFilesChecker;

class PhpLintTool
{
    /**
     * @var PhpLintToolExecutor
     */
    private $phpLintToolExecutor;

    /**
     * PhpLintToolProcessor constructor.
     * @param PhpLintToolExecutor $phpLintToolExecutor
     */
    public function __construct(PhpLintToolExecutor $phpLintToolExecutor)
    {
        $this->phpLintToolExecutor = $phpLintToolExecutor;
    }

    /**
     * @param array  $files
     * @param string $errorMessage
     */
    public function execute(array $files, $errorMessage)
    {
        if (true === PhpFilesChecker::exists($files)) {
            $this->phpLintToolExecutor->execute($files, $errorMessage);
        }
    }
}
