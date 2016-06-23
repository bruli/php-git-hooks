<?php

namespace PhpGitHooks\Module\PhpMd\Contract\Command;

use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandInterface;

class PhpMdToolCommand implements CommandInterface
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
     * @var string
     */
    private $options;

    /**
     * PhpMdToolCommand constructor.
     *
     * @param array  $files
     * @param string $options
     * @param string $errorMessage
     */
    public function __construct(array $files, $options, $errorMessage)
    {
        $this->files = $files;
        $this->errorMessage = $errorMessage;
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
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }
}
