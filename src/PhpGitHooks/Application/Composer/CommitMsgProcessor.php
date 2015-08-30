<?php

namespace PhpGitHooks\Application\Composer;

final class CommitMsgProcessor extends Processor
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
        if (!isset($configData['commit-msg'])) {
            $enable = $this->setQuestion('Do you want enable commit-msg hook?', '[Y/n]', 'Y');
            $enabled = 'Y' === strtoupper($enable) ? true : false;

            $this->configData['commit-msg'] = [
                'enabled' => $enabled,
            ];

            return $enabled;
        }

        $this->configData = $configData;

        return $configData['commit-msg']['enabled'];
    }

    private function setExpressionRegular()
    {
        if (!isset($this->configData['commit-msg']['expression-regular'])) {
            $answer = $this->setQuestion('Write an expression regular', '[#[0-9]{2,7}]', '#[0-9]{2,7}');
            $this->configData['commit-msg']['expression-regular'] = $answer;
        }
    }
}
