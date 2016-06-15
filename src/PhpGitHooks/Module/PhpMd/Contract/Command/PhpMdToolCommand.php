<?php

namespace PhpGitHooks\Module\PhpMd\Contract\Command;

use CommandBus\CommandBus\CommandInterface;

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
     * PhpMdToolCommand constructor.
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
