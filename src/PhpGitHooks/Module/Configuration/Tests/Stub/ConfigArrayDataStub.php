<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Service\HookQuestions;

class ConfigArrayDataStub
{
    const PHPCS_STANDARD = 'PSR2';
    const PHPUNIT_OPTIONS = '--suite default';
    const RIGHT_MESSAGE = 'good job';
    const REGULAR_EXPRESSION = '#[0-9]{2,7}';
    const ERROR_MESSAGE = 'fix your code';
    const PHPMD_OPTIONS = '--minimumpriority 1';
    const PHPCSFIXER_OPTIONS = '--diff';
    const MINIMUM_COVERAGE = 90.00;
    const EMPTY_STRING = '';

    /**
     * @return array
     */
    public static function hooksEnabledWithEnabledTools()
    {
        return [
            'pre-commit' => [
                'enabled' => true,
                'execute' => [
                    'composer' => true,
                    'jsonlint' => true,
                    'phplint' => true,
                    'phpmd' => [
                        'enabled' => true,
                        'options' => self::PHPMD_OPTIONS
                    ],
                    'phpcs' => [
                        'enabled' => true,
                        'standard' => static::PHPCS_STANDARD,
                        'ignore' => static::EMPTY_STRING,
                    ],
                    'php-cs-fixer' => [
                        'enabled' => true,
                        'levels' => [
                            'psr0' => true,
                            'psr1' => true,
                            'psr2' => true,
                            'symfony' => true,
                        ],
                        'options' => static::PHPCSFIXER_OPTIONS,
                    ],
                    'phpunit' => [
                        'enabled' => true,
                        'random-mode' => true,
                        'options' => static::PHPUNIT_OPTIONS,
                        'strict-coverage' => [
                            'enabled' => true,
                            'minimum' => self::MINIMUM_COVERAGE
                        ],
                        'guard-coverage' => [
                            'enabled' => true,
                            'message' => self::ERROR_MESSAGE
                        ],
                    ],
                ],
                'message' => [
                    'enable-faces' => true,
                    'right-message' => static::RIGHT_MESSAGE,
                    'error-message' => static::ERROR_MESSAGE,
                ],
            ],
            'commit-msg' => [
                'enabled' => true,
                'regular-expression' => static::REGULAR_EXPRESSION,
            ],
            'pre-push' => [
                'enabled' => true,
                'execute' => [
                    'phpunit' => [
                        'enabled' => true,
                        'random-mode' => true,
                        'options' => static::PHPUNIT_OPTIONS,
                        'strict-coverage' => [
                            'enabled' => true,
                            'minimum' => self::MINIMUM_COVERAGE
                        ],
                        'guard-coverage' => [
                            'enabled' => true,
                            'message' => self::ERROR_MESSAGE
                        ],
                    ]
                ],
                'message' => [
                    'enable-faces' => true,
                    'right-message' => HookQuestions::PRE_PUSH_RIGHT_MESSAGE_DEFAULT,
                    'error-message' => HookQuestions::PRE_PUSH_ERROR_MESSAGE_DEFAULT,
                ]
            ]
        ];
    }
}
