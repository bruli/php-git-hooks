<?php

namespace Module\PhpCs\Contract\Command;

use Infrastructure\CommandBus\CommandInterface;

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
     * PhpCsToolCommand constructor.
     *
     * @param array $files
     * @param string $standard
     * @param string $errorMessage
     */
    public function __construct(array $files, $standard, $errorMessage)
    {
        $this->files = $files;
        $this->standard = $standard;
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

    /**
     * @return string
     */
    public function getStandard()
    {
        return $this->standard;
    }
}
