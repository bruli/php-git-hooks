<?php

namespace PhpGitHooks\Module\Configuration\Service;

class HookQuestions
{
    const DEFAULT_TOOL_ANSWER = 'Y';
    const PRE_COMMIT_HOOK = '<info>Do you want enable PRE-COMMIT hook?:</info> <comment>[Y/n]</comment>';
    const PRE_COMMIT_RIGHT_MESSAGE = '<info>Write a right message for pre-commit hook:</info> ' .
    '<comment>' . self::PRE_COMMIT_RIGHT_MESSAGE_DEFAULT . '</comment>';
    const PRE_COMMIT_RIGHT_MESSAGE_DEFAULT = 'HEY, GOOD JOB!!';
    const PRE_COMMIT_ERROR_MESSAGE = '<info>Write a error message for pre-commit hook:</info> ' .
    '<comment>' . self::PRE_COMMIT_ERROR_MESSAGE_DEFAULT . '</comment>';
    const PRE_COMMIT_ERROR_MESSAGE_DEFAULT = 'FIX YOUR FUCKING CODE!!';
    const COMPOSER_TOOL = '<info>Do you want enable COMPOSER tool?:</info> <comment>[Y/n]</comment>';
    const JSONLINT_TOOL = '<info>Do you want enable JSONLINT tool?:</info> <comment>[Y/n]</comment>';
    const PHPLINT_TOOL = '<info>Do you want enable PHPLINT tool?:</info> <comment>[Y/n]</comment>';
    const PHPCS_TOOL = '<info>Do you want enable PHPCS tool?:</info> <comment>[Y/n]</comment>';
    const PHPCS_STANDARD = '<info>Which standard do you want to user for PHPCS tool?:</info> ' .
    '<comment>[PSR1/PSR2/PHPCS/MySource/Zend/Squiz/PEAR]</comment>';
    const PHPMD_TOOL = '<info>Do you want enable PHPMD tool?:</info> <comment>[Y/n]</comment>';
    const PHPCSFIXER_TOOL = '<info>Do you want enable PHP-CS-FIXER tool?:</info> <comment>[Y/n]</comment>';
    const PHPCSFIXER_PSR0_LEVEL = '<info>Enable psr0 level for PHP-CS-FIXER?:</info> <comment>[Y/n]</comment>';
    const PHPCSFIXER_PSR1_LEVEL = '<info>Enable psr1 level for PHP-CS-FIXER?:</info> <comment>[Y/n]</comment>';
    const PHPCSFIXER_PSR2_LEVEL = '<info>Enable psr2 level for PHP-CS-FIXER?:</info> <comment>[Y/n]</comment>';
    const PHPCSFIXER_SYMFONY_LEVEL = '<info>Enable symfony level for PHP-CS-FIXER?:</info> <comment>[Y/n]</comment>';
    const PHPUNIT_TOOL = '<info>Do you want enable PHPUNIT tool?:</info> <comment>[Y/n]</comment>';
    const PHPUNIT_RANDOM_MODE = '<info>Do you want run PHPUNIT tool with randomize mode?:</info>' .
    '<comment>[Y/n]</comment>';
    const PHPUNIT_OPTIONS = '<info>Write options for PHPUNIT tool if you want use it:</info> <comment>[NONE]</comment>';
    const COMMIT_MSG_HOOK = '<info>Do you want enable COMMIT_MSG hook?:</info> <comment>[Y/n]</comment>';
    const COMMIT_MSG_REGULAR_EXPRESSION = '<info>Write a regular expression:</info> ' .
    '<comment>' . self::COMMIT_MSG_REGULAR_EXPRESSION_ANSWER . '</comment>';
    const COMMIT_MSG_REGULAR_EXPRESSION_ANSWER = '[#[0-9]{2,7}]';
}
