<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\RegularExpression;

class CommitMsgConfigurator
{
    /**
     * @param IOInterface $io
     * @param CommitMsg   $commitMsg
     *
     * @return CommitMsg
     */
    public static function configure(IOInterface $io, CommitMsg $commitMsg)
    {
        $answer = $io->ask(HookQuestions::COMMIT_MSG_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER);

        $commitMsg = $commitMsg->setEnabled(new Enabled(HookQuestions::DEFAULT_TOOL_ANSWER === strtoupper($answer)));

        if (true === $commitMsg->isEnabled()) {
            $regularExpressionAnswer = $io->ask(
                HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION,
                HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION_ANSWER
            );

            $commitMsg = $commitMsg->addRegularExpression(new RegularExpression($regularExpressionAnswer));
        }

        return $commitMsg;
    }
}
