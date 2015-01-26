<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpUnitHandler
 * @package PhpGitHooks\Infrastructure\PhpUnit
 */
class PhpUnitHandler extends ToolHandler
{
    /**
     * @throws UnitTestsException
     */
    public function run()
    {
        $this->setTitle();

        $processBuilder = new ProcessBuilder(array('php', 'bin/phpunit'));
        $processBuilder->setTimeout(3600);
        $phpunit = $processBuilder->getProcess();
        $phpunit->run(function ($type, $buffer) {
            $type;
            $this->output->write($buffer);
        });

        if (!$phpunit->isSuccessful()) {
            throw new UnitTestsException();
        }
    }

    private function setTitle()
    {
        $this->outputHandler->setTitle('Running unit tests');
        $this->output->write($this->outputHandler->getTitle());
        $this->output->writeln($this->outputHandler->getSuccessfulStepMessage('Executing'));
    }
}
