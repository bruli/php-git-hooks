<?php

namespace PhpGitHooks\Application\PhpUnit;

use PhpGitHooks\Application\Config\AbstractToolConfigData;

final class PhpUnitConfigData extends AbstractToolConfigData
{
    const TOOL = 'phpunit';

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws PhpUnitConfigDataException
     */
    public function createConfigData(array $data)
    {
        $this->configData = $data;
        $this->setEnabled();
        $this->setRandomizerOption();

        return $this->configData[self::TOOL];
    }

    /**
     * @throws PhpUnitConfigDataException
     */
    private function checkConfigData()
    {
        $configData = $this->configData[self::TOOL];
        if (!is_array($configData)) {
            throw new PhpUnitConfigDataException();
        }

        if (!isset($configData['enabled'])) {
            throw new PhpUnitConfigDataException();
        }
    }

    /**
     * @return string
     */
    protected function getToolName()
    {
        return self::TOOL;
    }

    private function setRandomizerOption()
    {
        if (!isset($this->configData[self::TOOL]['random-mode'])) {
            $answer = $this
                ->setQuestion(
                    sprintf('Do you want run %s tool in randomize mode?', strtoupper(self::TOOL)),
                    'Y',
                    'Y/n'
                );
            $answer = 'Y' === strtoupper($answer) ? true : false;
        } else {
            $answer = $this->configData[self::TOOL]['random-mode'];
        }

        $this->configData[self::TOOL]['random-mode'] = $answer;
    }

    private function setEnabled()
    {
        if (!isset($this->configData[self::TOOL])) {
            $answer = $this->setQuestion(sprintf('Do you want enable %s tool: ', strtoupper(self::TOOL)), 'Y', 'Y/n');
            $answer = 'Y' === strtoupper($answer) ? true : false;
        } else {
            $this->checkConfigData();
            $answer = $this->configData[self::TOOL]['enabled'];
        }

        $this->enableTool($answer);
    }
}
