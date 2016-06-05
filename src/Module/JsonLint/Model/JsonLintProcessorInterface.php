<?php

namespace Module\JsonLint\Model;

interface JsonLintProcessorInterface
{
    /**
     * @param string $file
     */
    public function process($file);
}
