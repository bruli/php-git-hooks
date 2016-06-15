<?php

namespace PhpGitHooks\Module\PhpUnit\Model;

interface PhpUnitProcessorInterface
{
    /**
     * @param string $options
     *
     * @return bool
     */
    public function process($options);
}
