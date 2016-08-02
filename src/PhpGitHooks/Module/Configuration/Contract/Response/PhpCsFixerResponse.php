<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class PhpCsFixerResponse
{
    /**
     * @var bool
     */
    private $phpCsFixer;
    /**
     * @var bool
     */
    private $phpCsFixerPsr0;
    /**
     * @var bool
     */
    private $phpCsFixerPsr1;
    /**
     * @var bool
     */
    private $phpCsFixerPsr2;
    /**
     * @var bool
     */
    private $phpCsFixerSymfony;
    /**
     * @var string|null
     */
    private $phpCsFixerOptions;

    /**
     * PhpCsFixerResponse constructor.
     *
     * @param bool $phpCsFixer
     * @param bool $phpCsFixerPsr0
     * @param bool $phpCsFixerPsr1
     * @param bool $phpCsFixerPsr2
     * @param bool $phpCsFixerSymfony
     * @param string|null $phpCsFixerOptions
     */
    public function __construct(
        $phpCsFixer,
        $phpCsFixerPsr0,
        $phpCsFixerPsr1,
        $phpCsFixerPsr2,
        $phpCsFixerSymfony,
        $phpCsFixerOptions
    ) {
        $this->phpCsFixer = $phpCsFixer;
        $this->phpCsFixerPsr0 = $phpCsFixerPsr0;
        $this->phpCsFixerPsr1 = $phpCsFixerPsr1;
        $this->phpCsFixerPsr2 = $phpCsFixerPsr2;
        $this->phpCsFixerSymfony = $phpCsFixerSymfony;
        $this->phpCsFixerOptions = $phpCsFixerOptions;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixer()
    {
        return $this->phpCsFixer;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixerPsr0()
    {
        return $this->phpCsFixerPsr0;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixerPsr1()
    {
        return $this->phpCsFixerPsr1;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixerPsr2()
    {
        return $this->phpCsFixerPsr2;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixerSymfony()
    {
        return $this->phpCsFixerSymfony;
    }

    /**
     * @return null|string
     */
    public function getPhpCsFixerOptions()
    {
        return $this->phpCsFixerOptions;
    }
}
