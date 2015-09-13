<?php

namespace PhpGitHooks\Application\Composer;

use Composer\IO\IOInterface;

final class QuestionTool
{
    /**
     * @param IOInterface $ioInterface
     * @param string      $question
     * @param string      $defaultAnswer
     * @param string      $answersAllowed
     *
     * @return string
     */
    public static function setQuestion(IOInterface $ioInterface, $question, $defaultAnswer, $answersAllowed)
    {
        return $ioInterface
            ->ask(sprintf('<info>%s</info> [<comment>%s</comment>]', $question, $answersAllowed), $defaultAnswer);
    }
}
