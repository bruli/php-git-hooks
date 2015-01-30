<?php

namespace PhpGitHooks\Application\Composer;

use Composer\IO\IOInterface;

/**
 * Interface ProcessorHook
 * @package PhpGitHooks\Application\Composer
 */
interface ProcessorHook
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
