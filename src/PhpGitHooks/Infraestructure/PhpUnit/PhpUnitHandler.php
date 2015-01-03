<?php

namespace PhpGitHooks\Infraestructure\PhpUnit;

use PhpGitHooks\Infraestructure\Common\ToolHandler;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpUnitHandler
 * @package PhpGitHooks\Infraestructure\PhpUnit
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
            throw new UnitTestsException;
        }
    }

    private function setTitle()
    {
        $this->outputHandler->setTitle('Running unit tests');
        $this->output->write($this->outputHandler->getTitle());
        $this->output->writeln($this->outputHandler->getSuccessfulStepMessage('Executing'));
    }
}
