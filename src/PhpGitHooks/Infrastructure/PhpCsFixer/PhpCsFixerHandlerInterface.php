<?php

namespace PhpGitHooks\Infrastructure\PhpCsFixer;

interface PhpCsFixerHandlerInterface
{
    /**
     * @param array $levels
     */
    public function setLevels(array $levels);
}
