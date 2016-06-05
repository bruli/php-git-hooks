<?php

namespace Module\PhpLint\Model;

interface PhpLintToolProcessorInterface
{
    /**
     * @param string $file
     */
    public function process($file);
}
