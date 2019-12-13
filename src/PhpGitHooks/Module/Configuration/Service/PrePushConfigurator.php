<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Configuration\Domain\Messages;
use PhpGitHooks\Module\Configuration\Domain\PrePush;

class PrePushConfigurator
{
    public static function configure(IOInterface $input, PrePush $prePush)
    {
        $answer = $input->ask(HookQuestions::PRE_PUSH_HOOK_QUESTION, HookQuestions::DEFAULT_TOOL_ANSWER);

        $prePush = $prePush->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));

        if (true === $prePush->isEnabled()) {
            $rightMessageAnswer = $input
                ->ask(HookQuestions::PRE_PUSH_RIGHT_MESSAGE, HookQuestions::PRE_PUSH_RIGHT_MESSAGE_DEFAULT);
            $errorMessageAnswer = $input
                ->ask(HookQuestions::PRE_PUSH_ERROR_MESSAGE, HookQuestions::PRE_PUSH_ERROR_MESSAGE_DEFAULT);
            $enableFaces = $input
                ->ask(HookQuestions::PRE_PUSH_ENABLE_FACES_MESSAGE, HookQuestions::DEFAULT_TOOL_ANSWER);

            $prePush = $prePush->setMessages(
                new Messages(
                    new Message($rightMessageAnswer),
                    new Message($errorMessageAnswer),
                    new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($enableFaces))
                )
            );
        }

        return $prePush;
    }
}
