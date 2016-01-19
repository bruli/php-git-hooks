<?php

namespace PhpGitHooks\Application\CodeSniffer;

use PhpGitHooks\Application\Config\AbstractToolConfigData;

final class PhpCsConfigData extends AbstractToolConfigData
{
    const TOOL = 'phpcs';
    const STANDARD_KEY = 'standard';
    const STANDARDS_LIST = '[PSR2/PHPCS/MySource/Zend/Squiz/PSR1/PEAR]';
    const ENABLED_KEY = 'enabled';
    const DEFAULT_ANSWER = 'Y';
    /** @var string */
    private $standard = 'PSR2';

    /**
     * @param array $data
     *
     * @return array
     */
    public function createConfigData(array $data)
    {
        $this->configData = $data;
        $this->setEnabled();
        $this->setStandard();

        return $this->configData[self::TOOL];
    }

    /**
     * @return string
     */
    protected function getToolName()
    {
        return self::TOOL;
    }

    private function setEnabled()
    {
        if (!isset($this->configData[self::TOOL])) {
            $answer = $this->setQuestion(
                sprintf('Do you want enable %s tool: ', strtoupper(self::TOOL)),
                self::DEFAULT_ANSWER,
                '[Y/n]'
            );
            $answer = self::DEFAULT_ANSWER === strtoupper($answer) ? true : false;
        } else {
            $answer = $this->configData[self::TOOL][self::ENABLED_KEY];
        }

        $this->enableTool($answer);
    }

    private function setStandard()
    {
        if (!isset($this->configData[self::TOOL][self::STANDARD_KEY])) {
            $answer = $this->setQuestion(
                sprintf('Which standard do you want to use for %s tool: ', strtoupper(self::TOOL)),
                $this->standard,
                self::STANDARDS_LIST
            );
            $this->configData[self::TOOL][self::STANDARD_KEY] = $answer;
        }
    }
}
