<?php

namespace PhpGitHooks\Module\Configuration\Model;

use PhpGitHooks\Module\Configuration\Domain\Config;

interface ConfigurationFileReaderInterface
{
    /**
     * @return Config
     */
    public function getData();
}
