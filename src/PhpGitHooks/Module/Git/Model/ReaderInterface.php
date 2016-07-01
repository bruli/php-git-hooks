<?php

namespace PhpGitHooks\Module\Git\Model;

interface ReaderInterface
{
    /**
     * @return string
     */
    public function read();
}
