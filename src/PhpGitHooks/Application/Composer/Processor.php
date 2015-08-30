<?php

namespace PhpGitHooks\Application\Composer;

use Composer\IO\IOInterface;

abstract class Processor
{
    /**
     * @var array
     */
    protected $configData = [];

    /**
     * @var IOInterface
     */
    protected $io;
    /**
     * @param IOInterface $io
     */
    public function setIO(IOInterface $io)
    {
        $this->io = $io;
    }

    /**
     * @param string $question
     * @param string $answers
     * @param string $default
     *
     * @return string
     */
    protected function setQuestion($question, $answers, $default)
    {
        return $this->io
            ->ask(sprintf('<info>%s</info> [<comment>%s</comment>]: ', $question, $answers), $default);
    }

    /**
     * @param array $configData
     *
     * @return array
     */
    abstract public function execute(array $configData);
}
