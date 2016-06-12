<?php

namespace Module\PhpCs\Model;

interface PhpCsToolProcessorInterface
{
    /**
     * @param string $file
     * @param string $standard
     *
     * @return string
     */
    public function process($file, $standard);
}
