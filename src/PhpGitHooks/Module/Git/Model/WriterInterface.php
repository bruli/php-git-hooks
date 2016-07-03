<?php

namespace PhpGitHooks\Module\Git\Model;

interface WriterInterface
{
    /**
     * @param mixed $data
     */
    public function write($data);
}
