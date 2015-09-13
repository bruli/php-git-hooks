<?php

namespace PhpGitHooks\Application\PhpCsFixer;

use Composer\IO\IOInterface;
use PhpGitHooks\Application\Composer\QuestionTool;

final class PhpCsFixerConfigData
{
    const TOOL = 'php-cs-fixer';
    private $allowedLevels = ['psr0', 'psr1', 'psr2', 'symfony'];
    /** @var  IOInterface */
    private $io;
    /** @var array */
    private $configData = [];

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
     * @param array $data
     * @return array
     * @throws InvalidPhpCsFixerConfigDataException
     */
    public function createConfigData(array $data)
    {
        $this->configData = $data;
        if (!isset($this->configData[self::TOOL])) {
            $answer = $this->setQuestion(sprintf('Do you want enable %s tool: ', strtoupper(self::TOOL)), 'Y', '[Y/n]');
            $answer = 'Y' === strtoupper($answer) ? true : false;
        } else {
            $this->checkConfigData();
            $answer = $this->configData[self::TOOL]['enabled'];
        }

        $this->enableTool($answer);
        $this->createConfigLevels();


        return $this->configData[self::TOOL];
    }

    /**
     * @param string $question
     * @param string $default
     * @param string $answersAllowed
     *
     * @return string
     */
    private function setQuestion($question, $default, $answersAllowed)
    {
        return QuestionTool::setQuestion($this->io, $question, $default, $answersAllowed);
    }

    /**
     *
     * @throws InvalidPhpCsFixerConfigDataException
     */
    private function checkConfigData()
    {
        $configData = $this->configData[self::TOOL];

        if (false === is_array($configData)) {
            throw new InvalidPhpCsFixerConfigDataException();
        }

        if (false === isset($configData['enabled'])) {
            throw new InvalidPhpCsFixerConfigDataException();
        }
    }

    /**
     * @param $answer
     */
    private function enableTool($answer)
    {
        $this->configData[self::TOOL]['enabled'] = $answer;
    }

    private function createConfigLevels()
    {
        $configData = $this->configData[self::TOOL];
        foreach ($this->allowedLevels as $level) {
            if (!isset($configData['levels'][$level])) {
                $answerLevel = strtolower($this->setQuestion(
                    sprintf('Enable %s level for %s tool', $level, strtoupper(self::TOOL)),
                    'Y',
                    '[Y/n]'
                ));

                $answerLevel = 'Y' === strtoupper($answerLevel) ? true : false;

                $this->configData[self::TOOL]['levels'][$level] = $answerLevel;

            }
        }

    }
}
