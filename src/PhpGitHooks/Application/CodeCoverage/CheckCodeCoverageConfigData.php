<?php

namespace PhpGitHooks\Application\CodeCoverage;

use PhpGitHooks\Application\Config\AbstractToolConfigData;
use PhpGitHooks\Application\PhpCsFixer\InvalidPhpCsFixerConfigDataException;

class CheckCodeCoverageConfigData extends AbstractToolConfigData
{
    const TOOL = 'code-coverage';

    /**
     * @return string
     */
    protected function getToolName()
    {
        return self::TOOL;
    }

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
        $this->setMinimunCoveragePercentage();

        return $this->configData[self::TOOL];
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
            $answer = $this->configData[self::TOOL]['enabled'];
        }

        $this->enableTool($answer);
    }

    private function setMinimunCoveragePercentage()
    {
        $percentage = strtolower($this->setQuestion(
            'Wich pertenage do you want to set at least for the global coverage (default 70)',
            '70',
            '[1-100]'
        ));

        $this->configData[self::TOOL]['percentage'] = (int) $percentage;
    }
}
