<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Application\Message\MessageConfigData;

final class CommitMsgProcessor extends Processor
{
    const HOOK_NAME = 'commit-msg';

    /**
     * @param array $configData
     *
     * @return array
     */
    public function execute(array $configData)
    {
        if ($this->enableHook($configData)) {
            $this->setExpressionRegular();
            $this->setMessages($configData);
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
            $enable = $this->setQuestion('Do you want enable commit-msg hook?', '[Y/n]', 'Y');
            $enabled = 'Y' === strtoupper($enable) ? true : false;

            $this->configData[self::HOOK_NAME] = [
                'enabled' => $enabled,
            ];

            return $enabled;
        }

        $this->configData = $configData;

        return $configData[self::HOOK_NAME]['enabled'];
    }

    private function setExpressionRegular()
    {
        if (!isset($this->configData[self::HOOK_NAME]['regular-expression'])) {
            $answer = $this->setQuestion('Write an expression regular', '[#[0-9]{2,7}]', '#[0-9]{2,7}');
            $this->configData[self::HOOK_NAME]['regular-expression'] = $answer;
        }
    }

    private function setMessages(array $configData)
    {
        if (!isset($configData[self::HOOK_NAME][MessageConfigData::TOOL])) {
            $message = new MessageConfigData($this->io, self::HOOK_NAME);
            $this->configData[self::HOOK_NAME][MessageConfigData::TOOL] = $message->config($configData);
        }
    }
}
