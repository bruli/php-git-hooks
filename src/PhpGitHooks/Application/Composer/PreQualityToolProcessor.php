<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Application\CodeSniffer\PhpCsConfigData;
use PhpGitHooks\Application\Message\MessageConfigData;
use PhpGitHooks\Application\PhpCsFixer\PhpCsFixerConfigData;
use PhpGitHooks\Application\PhpUnit\PhpUnitConfigData;
use PhpGitHooks\Infrastructure\Composer\ProcessorInterface;

class PreQualityToolProcessor extends Processor implements ProcessorInterface
{
    protected $simpleTools = ['composer', 'jsonlint', 'phplint', 'phpmd'];

    /**
     * @param array $configData
     *
     * @return array
     */
    public function execute(array $configData)
    {
        if (true === $this->enableHook($configData)) {
            $hookData = $this->configData[$this->hookName()];
            $this->configMessage($hookData);

            $execute = $hookData['execute'];
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
    protected function enableHook(array $configData)
    {
        if (!isset($configData[$this->hookName()])) {
            $enable = $this->setQuestion(sprintf('Do you want enable %s hook?', $this->hookName()), '[Y/n]', 'Y');

            $enabled = 'Y' === strtoupper($enable) ? true : false;

            $this->configData[$this->hookName()] = [
                'enabled' => $enabled,
                'execute' => [],
            ];

            return $enabled;
        }

        $this->configData = $configData;

        return $configData[$this->hookName()]['enabled'];
    }

    /**
     * @param array $execute
     */
    protected function configSimpleTools(array $execute)
    {
        foreach ($this->simpleTools as $tool) {
            if (!isset($execute[$tool])) {
                $answer = $this->setQuestionTool($tool);
                $this->configData[$this->hookName()]['execute'][$tool] = 'Y' === strtoupper($answer) ? true : false;
            }
        }
    }

    /**
     * @param array $execute
     */
    protected function configComplexTools(array $execute)
    {
        $this->configPhpCs($execute);
        $this->configPhpCsFixer($execute);
        $this->configPhpUnit($execute);
    }

    /**
     * @param array $execute
     */
    protected function configPhpCs(array $execute)
    {
        $phpCsConfig = new PhpCsConfigData($this->io);
        $this->configData[$this->hookName()]['execute'][PhpCsConfigData::TOOL] = $phpCsConfig
            ->createConfigData($execute);
    }

    /**
     * @param array $execute
     */
    protected function configPhpCsFixer(array $execute)
    {
        $phpCsFixerConfig = new PhpCsFixerConfigData($this->io);
        $this->configData[$this->hookName()]['execute'][PhpCsFixerConfigData::TOOL] = $phpCsFixerConfig
            ->createConfigData($execute);
    }

    protected function configPhpUnit(array $execute)
    {
        $phpUnitConfig = new PhpUnitConfigData($this->io);
        $this->configData[$this->hookName()]['execute'][PhpUnitConfigData::TOOL] = $phpUnitConfig
            ->createConfigData($execute);
    }

    /**
     * @param string $tool
     *
     * @return string
     */
    protected function setQuestionTool($tool)
    {
        return $this->setQuestion(sprintf('Do you want enable %s tool?', strtoupper($tool)), '[Y/n]', 'Y');
    }

    /**
     * @param array $hookData
     */
    protected function configMessage(array $hookData)
    {
        $message = new MessageConfigData($this->io, $this->hookName());
        $this->configData[$this->hookName()][MessageConfigData::TOOL] = $message->config($hookData);
    }

    /**
     * @return string
     */
    public function hookName()
    {
    }
}
