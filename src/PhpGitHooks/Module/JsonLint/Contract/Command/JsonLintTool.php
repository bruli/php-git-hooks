<?php

namespace PhpGitHooks\Module\JsonLint\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class JsonLintTool implements CommandInterface
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
     * JsonLintToolCommand constructor.
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

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }
}
