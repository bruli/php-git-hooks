<?php

namespace PhpGitHooks\Application\PhpUnit;

class PhpUnitCheckCodeCoverageHandler extends PhpUnitHandler
{

    protected function setTitle()
    {
        $this->outputHandler->setTitle('Checking the code coverage of the overall project. ');
        $this->output->write($this->outputHandler->getTitle());
        $this->output->writeln($this->outputHandler->getSuccessfulStepMessage('Executing'));
    }
}
