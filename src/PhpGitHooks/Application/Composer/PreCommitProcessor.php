<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Application\CodeSniffer\PhpCsConfigData;
use PhpGitHooks\Application\PhpCsFixer\PhpCsFixerConfigData;
use PhpGitHooks\Application\PhpUnit\PhpUnitConfigData;

final class PreCommitProcessor extends Processor
{
    private $simpleTools = ['jsonlint', 'phplint', 'phpmd'];

    /**
     * @param array $configData
     *
     * @return array
     */
    public function execute(array $configData)
    {
        if (true === $this->enableHook($configData)) {
            $execute = $this->configData['pre-commit']['execute'];
            $this->configSimpleTools($execute);
            $this->configComplexTools($execute);
        }

        return $this->configData;
    }

    /**
     * @param array $configData
     *
     * @return bool
     */
    private function enableHook(array $configData)
    {
        if (!isset($configData['pre-commit'])) {
            $enable = $this->setQuestion('Do you want enable pre-commit hook?', '[Y/n]', 'Y');

            $enabled = 'Y' === strtoupper($enable) ? true : false;

            $this->configData['pre-commit'] = [
                'enabled' => $enabled,
                'execute' => [],
            ];

            return $enabled;
        }

        $this->configData = $configData;

        return $configData['pre-commit']['enabled'];
    }

    /**
     * @param array $execute
     */
    private function configSimpleTools(array $execute)
    {
        foreach ($this->simpleTools as $tool) {
            if (!isset($execute[$tool])) {
                $answer = $this->setQuestionTool($tool);
                $this->configData['pre-commit']['execute'][$tool] = 'Y' === strtoupper($answer) ? true : false;
            }
        }
    }

    /**
     * @param array $execute
     */
    private function configComplexTools(array $execute)
    {
        $this->configPhpCs($execute);
        $this->configPhpCsFixer($execute);
        $this->configPhpUnit($execute);
    }

    /**
     * @param array $execute
     */
    private function configPhpCs(array $execute)
    {
        $phpCsConfig = new PhpCsConfigData($this->io);
        $this->configData['pre-commit']['execute'][PhpCsConfigData::TOOL] = $phpCsConfig
            ->createConfigData($execute);
    }

    /**
     * @param array $execute
     */
    private function configPhpCsFixer(array $execute)
    {
        $phpCsFixerConfig = new PhpCsFixerConfigData($this->io);
        $this->configData['pre-commit']['execute'][PhpCsFixerConfigData::TOOL] = $phpCsFixerConfig
            ->createConfigData($execute);
    }

    private function configPhpUnit(array $execute)
    {
        $phpUnitconfig = new PhpUnitConfigData($this->io);
        $this->configData['pre-commit']['execute'][PhpUnitConfigData::TOOL] = $phpUnitconfig
            ->createConfigData($execute);
    }

    /**
     * @param string $tool
     *
     * @return string
     */
    private function setQuestionTool($tool)
    {
        return $this->setQuestion(sprintf('Do you want enable %s tool?', strtoupper($tool)), '[Y/n]', 'Y');
    }
}
