<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class PhpUnitResponse
{
    /**
     * @var bool
     */
    private $phpunit;
    /**
     * @var bool
     */
    private $phpunitRandomMode;
    /**
     * @var null|string
     */
    private $phpunitOptions;

    /**
     * PhpUnitResponse constructor.
     *
     * @param bool        $phpunit
     * @param bool        $phpunitRandomMode
     * @param string|null $phpunitOptions
     */
    public function __construct($phpunit, $phpunitRandomMode, $phpunitOptions)
    {
        $this->phpunit = $phpunit;
        $this->phpunitRandomMode = $phpunitRandomMode;
        $this->phpunitOptions = $phpunitOptions;
    }

    /**
     * @return bool
     */
    public function isPhpunit()
    {
        return $this->phpunit;
    }

    /**
     * @return bool
     */
    public function isPhpunitRandomMode()
    {
        return $this->phpunitRandomMode;
    }

    /**
     * @return null|string
     */
    public function getPhpunitOptions()
    {
        return $this->phpunitOptions;
    }
}
