<?php

namespace PhpGitHooks\Module\PhpCs\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class PhpCsToolCommand implements CommandInterface
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
    private $ignore;

    /**
     * PhpCsToolCommand constructor.
     *
     * @param array  $files
     * @param string $standard
     * @param string $errorMessage
     * @param string $ignore
     */
    public function __construct(array $files, $standard, $errorMessage, $ignore)
    {
        $this->files = $files;
        $this->standard = $standard;
        $this->errorMessage = $errorMessage;
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
