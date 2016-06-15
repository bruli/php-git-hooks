<?php

namespace Module\PhpUnit\Infrastructure\Tool;

use Module\PhpUnit\Model\PhpUnitProcessorInterface;
use Symfony\Component\Process\ProcessBuilder;

class PhpUnitRandomizerProcessor extends AbstractPhpUnitProcessor implements PhpUnitProcessorInterface
{
    /**
     * @param string $options
     *
     * @return bool
     */
    public function process($options)
    {
        $processBuilder = new ProcessBuilder(
            [
                'php',
                $this->toolPathFinder->find('phpunit-randomizer'),
                $options,
            ]
        );

        return $this->runProcess($processBuilder);
    }
}
