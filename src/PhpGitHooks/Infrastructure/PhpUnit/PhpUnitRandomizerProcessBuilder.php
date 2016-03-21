<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use Symfony\Component\Process\ProcessBuilder;

final class PhpUnitRandomizerProcessBuilder extends PhpUnitProcessBuilder
{
    /**
     * @return ProcessBuilder
     */
    public function getProcessBuilder()
    {
        $params = array('php', 'bin/phpunit-randomizer', '--order', 'rand');
        if ($this->suite) {
            $params[] = '--testsuite';
            $params[] = $this->suite;
        }
        return new ProcessBuilder($params);
    }
}
