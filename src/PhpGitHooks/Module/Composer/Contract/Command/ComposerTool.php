<?php

namespace PhpGitHooks\Module\Composer\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class ComposerTool implements CommandInterface
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
     * ComposerToolCommand constructor.
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
