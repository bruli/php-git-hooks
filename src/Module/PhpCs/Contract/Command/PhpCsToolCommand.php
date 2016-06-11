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
     * PhpCsToolCommand constructor.
     *
     * @param array  $files
     * @param string $standard
     */
    public function __construct(array $files, $standard)
    {
        $this->files = $files;
        $this->standard = $standard;
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
