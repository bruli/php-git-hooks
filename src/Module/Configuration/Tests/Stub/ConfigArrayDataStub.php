<?php

namespace Module\Configuration\Tests\Stub;

class ConfigArrayDataStub
{
    const PHPCS_STANDARD = 'PSR2';

    const PHPUNIT_OPTIONS = '--suite default';

    const RIGHT_MESSAGE = 'good job';

    const REGULAR_EXPRESSION = '#[0-9]{2,7}';

    const ERROR_MESSAGE = 'fix your code';

    public static function hooksEnabledWithoutTools()
    {
        return [
            'pre-commit' => [
                'enabled' => true,
                'execute' => []
            ],
            'commit-msg' => [
                'enabled' => true,
                'regular-expression' => self::REGULAR_EXPRESSION

            ]
        ];
    }
    
    public static function hooksEnabledWithEnabledTools()
    {
        return [
            'pre-commit' => [
                'enabled' => true,
                'execute' => [
                    'composer' => true,
                    'jsonlint' => true,
                    'phplint' => true,
                    'phpmd' => true,
                    'phpcs' => [
                        'enabled' => true,
                        'standard' => self::PHPCS_STANDARD
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
                        'options' => self::PHPUNIT_OPTIONS
                    ]
                ],
                'messages' => [
                    'right-message' => self::RIGHT_MESSAGE,
                    'error-message' => self::ERROR_MESSAGE
                ]
            ],
            'commit-msg' => [
                'enabled' => true,
                'regular-expression' => self::REGULAR_EXPRESSION

            ]
        ];
    }
}
