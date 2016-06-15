<?php

namespace PhpGitHooks\Module\PhpCsFixer\Model;

interface PhpCsFixerToolProcessorInterface
{
    /**
     * @param string $file
     * @param string $level
     *
     * @return string
     */
    public function process($file, $level);
}
