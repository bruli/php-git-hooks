<?php

namespace PhpGitHooks\Module\JsonLint\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class JsonLintToolCommand implements CommandInterface
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
     * JsonLintToolCommand constructor.
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
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }
}
