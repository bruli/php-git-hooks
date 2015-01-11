<?php

namespace PhpGitHooks\Composer;

use Composer\IO\IOInterface;

/**
 * Class Processor
 * @package PhpGitHooks\Composer
 */
abstract class Processor
{
    /** @var  IOInterface */
    protected $io;

    /**
     * @param $io
     */
    public function __construct($io)
    {
        $this->io = $io;
    }

    /**
     * @param  string $question
     * @param  string $answers
     * @param  string $default
     * @return string
     */
    protected function setQuestion($question, $answers, $default)
    {
        return $this->io
            ->ask(sprintf('<info>%s</info> [<comment>%s</comment>]: ', $question, $answers), $default);
    }
}
