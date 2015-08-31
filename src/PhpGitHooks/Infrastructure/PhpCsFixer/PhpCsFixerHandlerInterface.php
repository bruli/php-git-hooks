<?php

namespace PhpGitHooks\Infrastructure\PhpCsFixer;

interface PhpCsFixerHandlerInterface
{
    /**
     * @param string $level
     */
    public function setLevel($level);
}
