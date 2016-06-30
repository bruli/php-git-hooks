<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Contract\Response\CommitMsgResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpCsFixerResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpCsResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitGuardCoverageResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitStrictCoverageResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpMdResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PreCommitResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PrePushResponse;
use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Composer;
use PhpGitHooks\Module\Configuration\Domain\JsonLint;
use PhpGitHooks\Module\Configuration\Domain\PhpCs;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixer;
use PhpGitHooks\Module\Configuration\Domain\PhpLint;
use PhpGitHooks\Module\Configuration\Domain\PhpMd;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitGuardCoverage;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Domain\PrePush;

class ConfigurationDataResponseFactory
{
    /**
     * @param PreCommit             $preCommit
     * @param Composer              $composer
     * @param JsonLint              $jsonLint
     * @param PhpLint               $phpLint
     * @param PhpMd                 $phpMd
     * @param PhpCs                 $phpCs
     * @param PhpCsFixer            $phpCsFixer
     * @param PhpUnit               $phpUnit
     * @param PhpUnitStrictCoverage $phpUnitStrictCoverage
     * @param PhpUnitGuardCoverage  $phpUnitGuardCoverage
     * @param CommitMsg             $commitMsg
     * @param PrePush               $prePush
     * @param PhpUnit               $prePushPhpUnit
     * @param PhpUnitStrictCoverage $prePushStrictCoverage
     * @param PhpUnitGuardCoverage  $prePushGuardCoverage
     *
     * @return ConfigurationDataResponse
     */
    public static function build(
        PreCommit $preCommit,
        Composer $composer,
        JsonLint $jsonLint,
        PhpLint $phpLint,
        PhpMd $phpMd,
        PhpCs $phpCs,
        PhpCsFixer $phpCsFixer,
        PhpUnit $phpUnit,
        PhpUnitStrictCoverage $phpUnitStrictCoverage,
        PhpUnitGuardCoverage $phpUnitGuardCoverage,
        CommitMsg $commitMsg,
        PrePush $prePush,
        PhpUnit $prePushPhpUnit,
        PhpUnitStrictCoverage $prePushStrictCoverage,
        PhpUnitGuardCoverage $prePushGuardCoverage
    ) {
        $commitMsgResponse = new CommitMsgResponse(
            $commitMsg->isEnabled(),
            $commitMsg->getRegularExpression()->value()
        );

        $prePushResponse = new PrePushResponse(
            $prePush->isEnabled(),
            $prePush->getMessages()->getRightMessage(),
            $prePush->getMessages()->getErrorMessage(),
            new PhpUnitResponse(
                $prePushPhpUnit->isEnabled(),
                $prePushPhpUnit->getRandomMode()->value(),
                $prePushPhpUnit->getOptions()->value()
            ),
            new PhpUnitStrictCoverageResponse(
                $prePushStrictCoverage->isEnabled(),
                $prePushStrictCoverage->getMinimumStrictCoverage()->value()
            ),
            new PhpUnitGuardCoverageResponse(
                $prePushGuardCoverage->isEnabled(),
                $prePushGuardCoverage->getWarningMessage()->value()
            )
        );

        $preCommitResponse = new PreCommitResponse(
            $preCommit->isEnabled(),
            $preCommit->getMessages()->getRightMessage()->value(),
            $preCommit->getMessages()->getErrorMessage()->value(),
            $composer->isEnabled(),
            $jsonLint->isEnabled(),
            $phpLint->isEnabled(),
            new PhpMdResponse($phpMd->isEnabled(), $phpMd->getOptions()->value()),
            new PhpCsResponse($phpCs->isEnabled(), $phpCs->getStandard()->value()),
            new PhpCsFixerResponse(
                $phpCsFixer->isEnabled(),
                $phpCsFixer->getLevels()->getPsr0()->value(),
                $phpCsFixer->getLevels()->getPsr1()->value(),
                $phpCsFixer->getLevels()->getPsr2()->value(),
                $phpCsFixer->getLevels()->getSymfony()->value()
            ),
            new PhpUnitResponse(
                $phpUnit->isEnabled(),
                $phpUnit->getRandomMode()->value(),
                $phpUnit->getOptions()->value()
            ),
            new PhpUnitStrictCoverageResponse(
                $phpUnitStrictCoverage->isEnabled(),
                $phpUnitStrictCoverage->getMinimumStrictCoverage()->value()
            ),
            new PhpUnitGuardCoverageResponse(
                $phpUnitGuardCoverage->isEnabled(),
                $phpUnitGuardCoverage->getWarningMessage()->value()
            )
        );

        return new ConfigurationDataResponse($preCommitResponse, $commitMsgResponse, $prePushResponse);
    }
}
