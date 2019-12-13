<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\PhpCs;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixer;
use PhpGitHooks\Module\Configuration\Domain\PhpMd;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitGuardCoverage;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Domain\PrePush;

class ConfigurationArrayTransformer
{
    /**
     * @param PreCommit $preCommit
     * @param CommitMsg $commitMsg
     * @param PrePush $prePush
     *
     * @return array
     */
    public static function transform(PreCommit $preCommit, CommitMsg $commitMsg, PrePush $prePush)
    {
        $tools = $preCommit->getExecute()->execute();
        $prePushTools = $prePush->getExecute()->execute();
        $composer = $tools[0];
        $jsonLint = $tools[1];
        $phpLint = $tools[2];
        /** @var PhpMd $phpMd */
        $phpMd = $tools[3];
        /** @var PhpCs $phpCs */
        $phpCs = $tools[4];
        /** @var PhpCsFixer $phpCsFixer */
        $phpCsFixer = $tools[5];
        /** @var PhpUnit $phpunit */
        $phpunit = $tools[6];
        /** @var PhpUnitStrictCoverage $phpUnitStrictCoverage */
        $phpUnitStrictCoverage = $tools[7];
        /** @var PhpUnitGuardCoverage $phpUnitGuardCoverage */
        $phpUnitGuardCoverage = $tools[8];
        
        /** @var PhpUnit $phpunitPrePush */
        $phpunitPrePush = $prePushTools[0];
        /** @var PhpUnitStrictCoverage $phpUnitStrictCoveragePrePush */
        $phpUnitStrictCoveragePrePush = $prePushTools[1];
        /** @var PhpUnitGuardCoverage $phpUnitGuardCoveragePrePush */
        $phpUnitGuardCoveragePrePush = $prePushTools[2];

        return [
            'pre-commit' => [
                'enabled' => $preCommit->isEnabled(),
                'execute' => [
                    'composer' => $composer->isEnabled(),
                    'jsonlint' => $jsonLint->isEnabled(),
                    'phplint' => $phpLint->isEnabled(),
                    'phpmd' => [
                        'enabled' => $phpMd->isEnabled(),
                        'options' => $phpMd->getOptions()->value(),
                    ],
                    'phpcs' => [
                        'enabled' => $phpCs->isEnabled(),
                        'standard' => $phpCs->getStandard()->value(),
                        'ignore' => $phpCs->getIgnore()->value(),
                    ],
                    'php-cs-fixer' => [
                        'enabled' => $phpCsFixer->isEnabled(),
                        'levels' => [
                            'psr0' => $phpCsFixer->getLevels()->getPsr0()->value(),
                            'psr1' => $phpCsFixer->getLevels()->getPsr1()->value(),
                            'psr2' => $phpCsFixer->getLevels()->getPsr2()->value(),
                            'symfony' => $phpCsFixer->getLevels()->getSymfony()->value(),
                        ],
                        'options' => $phpCsFixer->getOptions()->value(),
                    ],
                    'phpunit' => [
                        'enabled' => $phpunit->isEnabled(),
                        'random-mode' => $phpunit->getRandomMode()->value(),
                        'options' => $phpunit->getOptions()->value(),
                        'strict-coverage' => [
                            'enabled' => $phpUnitStrictCoverage->isEnabled(),
                            'minimum' => $phpUnitStrictCoverage->getMinimumStrictCoverage()->value(),
                        ],
                        'guard-coverage' => [
                            'enabled' => $phpUnitGuardCoverage->isEnabled(),
                            'message' => $phpUnitGuardCoverage->getWarningMessage()->value(),
                        ],
                    ],
                ],
                'message' => [
                    'enable-faces' => $preCommit->getMessages()->getEnableFaces()->value(),
                    'right-message' => $preCommit->getMessages()->getRightMessage()->value(),
                    'error-message' => $preCommit->getMessages()->getErrorMessage()->value(),
                ],
            ],
            'commit-msg' => [
                'enabled' => $commitMsg->isEnabled(),
                'regular-expression' => $commitMsg->getRegularExpression()->value(),
            ],
            'pre-push' => [
                'enabled' => $prePush->isEnabled(),
                'execute' => [
                    'phpunit' => [
                        'enabled' => $phpunitPrePush->isEnabled(),
                        'random-mode' => $phpunitPrePush->getRandomMode()->value(),
                        'options' => $phpunitPrePush->getOptions()->value(),
                        'strict-coverage' => [
                            'enabled' => $phpUnitStrictCoveragePrePush->isEnabled(),
                            'minimum' => $phpUnitStrictCoveragePrePush->getMinimumStrictCoverage()->value(),
                        ],
                        'guard-coverage' => [
                            'enabled' => $phpUnitGuardCoveragePrePush->isEnabled(),
                            'message' => $phpUnitGuardCoveragePrePush->getWarningMessage()->value()
                        ],
                    ],
                ],
                'message' => [
                    'enable-faces' => $preCommit->getMessages()->getEnableFaces()->value(),
                    'right-message' => $prePush->getMessages()->getRightMessage()->value(),
                    'error-message' => $prePush->getMessages()->getErrorMessage()->value(),
                ],
            ],
        ];
    }
}
