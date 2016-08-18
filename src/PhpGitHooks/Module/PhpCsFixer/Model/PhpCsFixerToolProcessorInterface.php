<?php

namespace PhpGitHooks\Module\PhpCsFixer\Model;

interface PhpCsFixerToolProcessorInterface
{
    /**
     * @param string $file
     * @param string $level
     * @param string $options
     *
     * @return string
     */
    public function process($file, $level, $options);
}
