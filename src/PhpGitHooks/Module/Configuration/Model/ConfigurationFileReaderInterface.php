<?php

namespace PhpGitHooks\Module\Configuration\Model;

interface ConfigurationFileReaderInterface
{
    /**
     * @return array
     */
    public function getData();
}
