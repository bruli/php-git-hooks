<?php

namespace PhpGitHooks\Application\Config;

use Composer\IO\IOInterface;
use PhpGitHooks\Application\Composer\QuestionTool;

abstract class AbstractToolConfigData
{
    /** @var  IOInterface */
    protected $io;
    /** @var array */
    protected $configData = [];

    /**
     * PhpCsFixerConfigData constructor.
     *
     * @param IOInterface $io
     */
    public function __construct(IOInterface $io)
    {
        $this->io = $io;
    }

    /**
     * @param string $question
     * @param string $default
     * @param string $answersAllowed
     *
     * @return string
     */
    protected function setQuestion($question, $default, $answersAllowed)
    {
        return QuestionTool::setQuestion($this->io, $question, $default, $answersAllowed);
    }

    /**
     * @return string
     */
    abstract protected function getToolName();

    /**
     * @param $answer
     */
    protected function enableTool($answer)
    {
        $this->configData[$this->getToolName()]['enabled'] = $answer;
    }

    /**
     * @param array $data
     *
     * @return array
     *
     */
    public abstract function createConfigData(array $data);
}
