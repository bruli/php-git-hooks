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
        $params = array('php', $bin, '--order', 'rand');
        if ($this->suite) {
            $params[] = '--testsuite';
            $params[] = $this->suite;
        }

        return new ProcessBuilder($params);
    }
}
