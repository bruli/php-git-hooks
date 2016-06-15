<?php

namespace Module\PhpUnit\Infrastructure\Tool;

use Module\PhpUnit\Model\PhpUnitProcessorInterface;
use Symfony\Component\Process\Process;

class PhpUnitRandomizerProcessor extends AbstractPhpUnitProcessor implements PhpUnitProcessorInterface
{
    /**
     * @param string $options
     *
     * @return bool
     */
    public function process($options)
    {
        $tool = sprintf('php %s %s %s', $this->toolPathFinder->find('phpunit-randomizer'), '--order rand', $options);

        $process = new Process($tool);

        return $this->runProcess($process);
    }
}
