<?php

namespace PhpGitHooks\Module\PhpMd\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class PhpMdTool implements CommandInterface
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
     * @var string
     */
    private $options;

    /**
     * PhpMdToolCommand constructor.
     *
     * @param array $files
     * @param string $options
     * @param string $errorMessage
     * @param bool $enableFaces
     */
    public function __construct(array $files, $options, $errorMessage, $enableFaces)
    {
        $this->files = $files;
        $this->errorMessage = $errorMessage;
        $this->enableFaces = $enableFaces;
        $this->options = $options;
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

    /**
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }
}
