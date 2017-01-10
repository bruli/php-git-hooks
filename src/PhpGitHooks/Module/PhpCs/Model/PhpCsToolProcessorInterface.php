<?php

namespace PhpGitHooks\Module\PhpCs\Model;

interface PhpCsToolProcessorInterface
{
    /**
     * @param string $file
     * @param string $standard
     * @param string $ignore
     *
     * @return string
     */
    public function process($file, $standard, $ignore);
}
