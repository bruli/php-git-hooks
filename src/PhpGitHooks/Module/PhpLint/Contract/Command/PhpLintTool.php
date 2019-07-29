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
     * @var bool
     */
    private $enableFaces;

    /**
     * PhpLintToolCommand constructor.
     *
     * @param array $files
     * @param string $errorMessage
     * @param bool $enableFaces
     */
    public function __construct(array $files, $errorMessage, $enableFaces)
    {
        $this->files = $files;
        $this->errorMessage = $errorMessage;
        $this->enableFaces = $enableFaces;
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

    /**
     * @return bool
     */
    public function isEnableFaces()
    {
        return $this->enableFaces;
    }
}
