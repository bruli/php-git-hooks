<?php

namespace PhpGitHooks\Module\PhpLint\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class PhpLintTool implements CommandInterface
{
    /**
     * @var array
     */
    private $files;
    /**
     * @var string
     */
    private $errorMessage;

    /**
     * PhpLintToolCommand constructor.
     *
     * @param array  $files
     * @param string $errorMessage
     */
    public function __construct(array $files, $errorMessage)
    {
        $this->files = $files;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}
