<?php

namespace Module\Configuration\Tests\Stub;

class ConfigArrayDataStub
{
    const PHPCS_STANDARD = 'PSR2';

    const PHPUNIT_OPTIONS = '--suite default';

    public static function hooksEnabledWithoutTools()
    {
        return [
            'pre-commit' => [
                'enabled' => true,
                'execute' => []
            ],
            'commit-msg' => [
                'enabled' => true,
                'regular-expression' => '#[0-9]{2,7}'

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
                'message' => [
                    'right-message' => 'good job',
                    'error-message' => 'fix your code'
                ]
            ],
            'commit-msg' => [
                'enabled' => true,
                'regular-expression' => '#[0-9]{2,7}'

            ]
        ];
    }
}
