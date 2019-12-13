<?php

namespace PhpGitHooks\Module\PhpCsFixer\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class PhpCsFixerTool implements CommandInterface
{
    /**
     * @var array
     */
    private $files;
    /**
     * @var bool
     */
    private $psr0;
    /**
     * @var bool
     */
    private $psr1;
    /**
     * @var bool
     */
    private $psr2;
    /**
     * @var bool
     */
    private $symfony;
    /**
     * @var string
     */
    private $options;
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var bool
     */
    private $enableFaces;

    /**
     * PhpCsFixerToolCommand constructor.
     *
     * @param array $files
     * @param bool $psr0
     * @param bool $psr1
     * @param bool $psr2
     * @param bool $symfony
     * @param string $options
     * @param string $errorMessage
     * @param bool $enableFaces
     */
    public function __construct(array $files, $psr0, $psr1, $psr2, $symfony, $options, $errorMessage, $enableFaces)
    {
        $this->files = $files;
        $this->psr0 = $psr0;
        $this->psr1 = $psr1;
        $this->psr2 = $psr2;
        $this->symfony = $symfony;
        $this->options = $options;
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
     * @return bool
     */
    public function isPsr0()
    {
        return $this->psr0;
    }

    /**
     * @return bool
     */
    public function isPsr1()
    {
        return $this->psr1;
    }

    /**
     * @return bool
     */
    public function isPsr2()
    {
        return $this->psr2;
    }

    /**
     * @return bool
     */
    public function isSymfony()
    {
        return $this->symfony;
    }

    /**
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
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
