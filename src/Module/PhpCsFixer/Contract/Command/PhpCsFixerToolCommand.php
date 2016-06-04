<?php

namespace Module\PhpCsFixer\Contract\Command;

class PhpCsFixerToolCommand
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
     * PhpCsFixerToolCommand constructor.
     *
     * @param array $files
     * @param bool  $psr0
     * @param bool  $psr1
     * @param bool  $psr2
     * @param bool  $symfony
     */
    public function __construct(array $files, $psr0, $psr1, $psr2, $symfony)
    {
        $this->files = $files;
        $this->psr0 = $psr0;
        $this->psr1 = $psr1;
        $this->psr2 = $psr2;
        $this->symfony = $symfony;
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
}
