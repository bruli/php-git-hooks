<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use Symfony\Component\Process\ProcessBuilder;

final class PhpUnitRandomizerProcessBuilder extends PhpUnitProcessBuilder
{
    /**
     * @param string $bin
     *
     * @return ProcessBuilder
     */
    public function getProcessBuilder($bin)
    {
        return new ProcessBuilder(array('php', $bin, '--order', 'rand'));
    }
}
