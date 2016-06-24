<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class PhpMdResponse
{
    /**
     * @var bool
     */
    private $phpMd;
    /**
     * @var null|string
     */
    private $phpMdOptions;

    /**
     * PhpMdResponse constructor.
     *
     * @param bool        $phpMd
     * @param string|null $phpMdOptions
     */
    public function __construct($phpMd, $phpMdOptions)
    {
        $this->phpMd = $phpMd;
        $this->phpMdOptions = $phpMdOptions;
    }

    /**
     * @return bool
     */
    public function isPhpMd()
    {
        return $this->phpMd;
    }

    /**
     * @return null|string
     */
    public function getPhpMdOptions()
    {
        return $this->phpMdOptions;
    }
}
