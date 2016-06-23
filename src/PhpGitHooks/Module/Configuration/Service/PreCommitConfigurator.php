<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Configuration\Domain\Messages;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;

class PreCommitConfigurator
{
    /**
     * @param IOInterface $io
     * @param PreCommit   $preCommit
     *
     * @return PreCommit
     */
    public static function configure(IOInterface $io, PreCommit $preCommit)
    {
        $answer = $io->ask(HookQuestions::PRE_COMMIT_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER);

        $preCommit = $preCommit->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));

        if (true === $preCommit->isEnabled()) {
            $rightMessageAnswer = $io
                ->ask(HookQuestions::PRE_COMMIT_RIGHT_MESSAGE, HookQuestions::PRE_COMMIT_RIGHT_MESSAGE_DEFAULT);
            $errorMessageAnswer = $io
                ->ask(HookQuestions::PRE_COMMIT_ERROR_MESSAGE, HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT);

            $preCommit = $preCommit->setMessages(new Messages(
                new Message($rightMessageAnswer),
                new Message($errorMessageAnswer)
            ));
        }

        return $preCommit;
    }
}
