<?php

namespace PhpGitHooks\Module\PhpMd\Model;

interface PhpMdToolProcessorInterface
{
    /**
     * @param string $file
     * @param string $options
     *
     * @return string
     */
    public function process($file, $options);
}
