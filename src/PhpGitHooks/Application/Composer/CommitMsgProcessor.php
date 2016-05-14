<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Composer\ProcessorInterface;

final class CommitMsgProcessor extends Processor implements ProcessorInterface
{
    /**
     * @param array $configData
     *
     * @return array
     */
    public function execute(array $configData)
    {
        if ($this->enableHook($configData)) {
            $this->setExpressionRegular();
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
        if (!isset($configData[$this->hookName()])) {
            $enable = $this->setQuestion('Do you want enable commit-msg hook?', '[Y/n]', 'Y');
            $enabled = 'Y' === strtoupper($enable) ? true : false;

            $this->configData[$this->hookName()] = [
                'enabled' => $enabled,
            ];

            return $enabled;
        }

        $this->configData = $configData;

        return $configData[$this->hookName()]['enabled'];
    }

    private function setExpressionRegular()
    {
        if (!isset($this->configData[$this->hookName()]['regular-expression'])) {
            $answer = $this->setQuestion('Write an expression regular', '[#[0-9]{2,7}]', '#[0-9]{2,7}');
            $this->configData[$this->hookName()]['regular-expression'] = $answer;
        }
    }

    /**
     * @return string
     */
    public function hookName()
    {
        return 'commit-msg';
    }
}
