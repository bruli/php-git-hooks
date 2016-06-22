<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

class ConfigArrayDataStub
{
    const PHPCS_STANDARD = 'PSR2';
    const PHPUNIT_OPTIONS = '--suite default';
    const RIGHT_MESSAGE = 'good job';
    const REGULAR_EXPRESSION = '#[0-9]{2,7}';
    const ERROR_MESSAGE = 'fix your code';
    const PHPMD_OPTIONS = '--minimumpriority 1';

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
                    ],
                    'php-cs-fixer' => [
                        'enabled' => true,
                        'levels' => [
                            'psr0' => true,
                            'psr1' => true,
                            'psr2' => true,
                            'symfony' => true,
                        ],
                    ],
                    'phpunit' => [
                        'enabled' => true,
                        'random-mode' => true,
                        'options' => static::PHPUNIT_OPTIONS,
                    ],
                ],
                'message' => [
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
                        'options' => static::PHPUNIT_OPTIONS
                    ]
                ],
                'message' => [
                    'right-message' => static::RIGHT_MESSAGE,
                    'error-message' => static::ERROR_MESSAGE,
                ]
            ]
        ];
    }
}
