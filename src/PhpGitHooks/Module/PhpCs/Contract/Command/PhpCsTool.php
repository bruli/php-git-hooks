<?php

namespace PhpGitHooks\Module\PhpCs\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class PhpCsTool implements CommandInterface
{
    /**
     * @var array
     */
    private $files;
    /**
     * @var string
     */
    private $standard;
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var string
     */
    private $enableFaces;
    /**
     * @var string
     */
    private $ignore;

    /**
     * PhpCsToolCommand constructor.
     *
     * @param array $files
     * @param string $standard
     * @param string $errorMessage
     * @param bool $enableFaces
     * @param string $ignore
     */
    public function __construct(array $files, $standard, $errorMessage, $enableFaces, $ignore)
    {
        $this->files = $files;
        $this->standard = $standard;
        $this->errorMessage = $errorMessage;
        $this->enableFaces = $enableFaces;
        $this->ignore = $ignore;
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

    /**
     * @return string
     */
    public function getStandard()
    {
        return $this->standard;
    }

    /**
     * @return string
     */
    public function getIgnore()
    {
        return $this->ignore;
    }
}
