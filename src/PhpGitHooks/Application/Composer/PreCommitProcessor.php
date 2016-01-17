<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Application\CodeSniffer\PhpCsConfigData;
use PhpGitHooks\Application\Message\MessageConfigData;
use PhpGitHooks\Application\PhpCsFixer\PhpCsFixerConfigData;
use PhpGitHooks\Application\PhpUnit\PhpUnitConfigData;

final class PreCommitProcessor extends Processor
{
    private $simpleTools = ['composer', 'jsonlint', 'phplint', 'phpmd'];
    const HOOK_NAME = 'pre-commit';

    /**
     * @param array $configData
     *
     * @return array
     */
    public function execute(array $configData)
    {
        if (true === $this->enableHook($configData)) {
            $preCommit = $this->configData[self::HOOK_NAME];
            $this->configMessage($preCommit);

            $execute = $preCommit['execute'];
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
        if (!isset($configData[self::HOOK_NAME])) {
            $enable = $this->setQuestion('Do you want enable pre-commit hook?', '[Y/n]', 'Y');

            $enabled = 'Y' === strtoupper($enable) ? true : false;

            $this->configData[self::HOOK_NAME] = [
                'enabled' => $enabled,
                'execute' => [],
            ];

            return $enabled;
        }

        $this->configData = $configData;

        return $configData[self::HOOK_NAME]['enabled'];
    }

    /**
     * @param array $execute
     */
    private function configSimpleTools(array $execute)
    {
        foreach ($this->simpleTools as $tool) {
            if (!isset($execute[$tool])) {
                $answer = $this->setQuestionTool($tool);
                $this->configData[self::HOOK_NAME]['execute'][$tool] = 'Y' === strtoupper($answer) ? true : false;
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
        $this->configData[self::HOOK_NAME]['execute'][PhpCsConfigData::TOOL] = $phpCsConfig
            ->createConfigData($execute);
    }

    /**
     * @param array $execute
     */
    private function configPhpCsFixer(array $execute)
    {
        $phpCsFixerConfig = new PhpCsFixerConfigData($this->io);
        $this->configData[self::HOOK_NAME]['execute'][PhpCsFixerConfigData::TOOL] = $phpCsFixerConfig
            ->createConfigData($execute);
    }

    private function configPhpUnit(array $execute)
    {
        $phpUnitConfig = new PhpUnitConfigData($this->io);
        $this->configData[self::HOOK_NAME]['execute'][PhpUnitConfigData::TOOL] = $phpUnitConfig
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

    /**
     * @param array $hookData
     */
    private function configMessage(array $hookData)
    {
        $message = new MessageConfigData($this->io, self::HOOK_NAME);
        $this->configData[self::HOOK_NAME][MessageConfigData::TOOL] = $message->config($hookData);
    }
}
