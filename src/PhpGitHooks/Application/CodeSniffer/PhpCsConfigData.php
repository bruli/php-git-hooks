<?php

namespace PhpGitHooks\Application\CodeSniffer;

use PhpGitHooks\Application\Config\AbstractToolConfigData;

final class PhpCsConfigData extends AbstractToolConfigData
{
    const TOOL = 'phpcs';
    /** @var string */
    private $standard = 'PSR2';

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws InvalidPhpCsConfigDataException
     */
    public function createConfigData(array $data)
    {
        $this->configData = $data;
        $this->setEnabled();
        $this->setStandard();

        return $this->configData[self::TOOL];
    }

    /**
     * @throws InvalidPhpCsConfigDataException
     */
    private function checkConfigData()
    {
        $configData = $this->configData[self::TOOL];

        if (false === is_array($configData)) {
            throw new InvalidPhpCsConfigDataException();
        }

        if (false === isset($configData['enabled'])) {
            throw new InvalidPhpCsConfigDataException();
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
     * @throws InvalidPhpCsConfigDataException
     */
    private function setEnabled()
    {
        if (!isset($this->configData[self::TOOL])) {
            $answer = $this->setQuestion(
                sprintf('Do you want enable %s tool: ', strtoupper(self::TOOL)),
                'Y',
                '[Y/n]'
            );
            $answer = 'Y' === strtoupper($answer) ? true : false;
        } else {
            $this->checkConfigData();
            $answer = $this->configData[self::TOOL]['enabled'];
        }

        $this->enableTool($answer);
    }

    /**
     * @throws InvalidPhpCsConfigDataException
     */
    private function setStandard()
    {
        if (!isset($this->configData[self::TOOL]['standard'])) {
            $answer = $this->setQuestion(
                sprintf('Which standard do you want to use for %s tool: ', strtoupper(self::TOOL)),
                $this->standard,
                '[PSR2/PHPCS/MySource/Zend/Squiz/PSR1/PEAR]'
            );
            $this->configData[self::TOOL]['standard'] = $answer;
        }
    }
}
