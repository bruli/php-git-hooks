<?php

namespace PhpGitHooks\Application\Composer;

use Composer\IO\IOInterface;

/**
 * Interface ProcessorHook.
 */
interface ProcessorHookInterface
{
    /**
     * @return array
     */
    public function execute();

    /**
     * @param IOInterface $io
     */
    public function setIO(IOInterface $io);
}
