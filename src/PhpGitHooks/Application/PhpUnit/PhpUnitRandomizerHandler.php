<?php

namespace PhpGitHooks\Application\PhpUnit;

class PhpUnitRandomizerHandler extends PhpUnitHandler
{
    /**
     * @return \Symfony\Component\Process\ProcessBuilder
     */
    protected function processBuilder()
    {
        return $this->phpUnitProcessBuilder->getProcessBuilder($this->getBinPath('phpunit-randomizer'));
    }
}
