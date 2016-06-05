<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\CommitMsg;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsFixer;
use Module\Configuration\Domain\PhpUnit;
use Module\Configuration\Domain\PreCommit;

class ConfigurationArrayTransformer
{
    public static function transform(PreCommit $preCommit, CommitMsg $commitMsg)
    {

        $tools = $preCommit->getExecute()->execute();
        $composer = $tools[0];
        $jsonLint = $tools[1];
        $phpLint = $tools[2];
        $phpMd = $tools[3];
        /** @var PhpCs $phpCs */
        $phpCs = $tools[4];
        /** @var PhpCsFixer $phpCsFixer */
        $phpCsFixer = $tools[5];
        /** @var PhpUnit $phpunit */
        $phpunit = $tools[6];
        return [
            'pre-commit' => [
                'enabled' => $preCommit->isEnabled(),
                'process' => [
                    'composer' => $composer->isEnabled(),
                    'jsonlint' => $jsonLint->isEnabled(),
                    'phplint' => $phpLint->isEnabled(),
                    'phpmd' => $phpMd->isEnabled(),
                    'phpcs' => [
                        'enabled' => $phpCs->isEnabled(),
                        'standard' => $phpCs->getStandard()->value()
                    ],
                    'php-cs-fixer'  => [
                        'enabled' => $phpCsFixer->isEnabled(),
                        'levels' => [
                            'psr0' => $phpCsFixer->getLevels()->getPsr0()->value(),
                            'psr1' => $phpCsFixer->getLevels()->getPsr1()->value(),
                            'psr2' => $phpCsFixer->getLevels()->getPsr2()->value(),
                            'symfony' => $phpCsFixer->getLevels()->getSymfony()->value(),
                        ]
                    ],
                    'phpunit' => [
                        'enabled' => $phpunit->isEnabled(),
                        'random-mode' => $phpunit->getRandomMode()->value(),
                        'options'  => $phpunit->getOptions()->value()
                    ]
                ],
                'messages' => [
                    'right-message' => $preCommit->getMessages()->getRightMessage()->value(),
                    'error-message' => $preCommit->getMessages()->getErrorMessage()->value()
                ]
            ],
            'commit-msg' => [
                'enabled' => $commitMsg->isEnabled(),
                'regular-expression' => $commitMsg->getRegularExpression()->value()
            ]
        ];
    }
}
