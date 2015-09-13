<?php

namespace PhpGitHooks\Application\PhpCsFixer;

use PhpGitHooks\Application\Config\AbstractToolConfigData;

final class PhpCsFixerConfigData extends AbstractToolConfigData
{
    const TOOL = 'php-cs-fixer';
    /** @var array  */
    private $allowedLevels = ['psr0', 'psr1', 'psr2', 'symfony'];

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws InvalidPhpCsFixerConfigDataException
     */
    public function createConfigData(array $data)
    {
        $this->configData = $data;
        $this->setEnabled();
        $this->createConfigLevels();

        return $this->configData[self::TOOL];
    }

    /**
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

    /**
     * @return string
     */
    protected function getToolName()
    {
        return self::TOOL;
    }

    /**
     * @throws InvalidPhpCsFixerConfigDataException
     */
    private function setEnabled()
    {
        if (!isset($this->configData[self::TOOL])) {
            $answer = $this->setQuestion(sprintf('Do you want enable %s tool: ', strtoupper(self::TOOL)), 'Y', '[Y/n]');
            $answer = 'Y' === strtoupper($answer) ? true : false;
        } else {
            $this->checkConfigData();
            $answer = $this->configData[self::TOOL]['enabled'];
        }

        $this->enableTool($answer);
    }
}
