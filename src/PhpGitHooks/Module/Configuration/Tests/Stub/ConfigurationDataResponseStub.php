<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\CommitMsgResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PreCommitResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PrePushResponse;

final class ConfigurationDataResponseStub
{
    /**
     * @param PreCommitResponse $preCommitResponse
     * @param CommitMsgResponse $commitMsgResponse
     * @param PrePushResponse   $prePushResponse
     *
     * @return ConfigurationDataResponse
     */
    public static function create(
        PreCommitResponse $preCommitResponse,
        CommitMsgResponse $commitMsgResponse,
        PrePushResponse $prePushResponse
    ) {
        return new ConfigurationDataResponse($preCommitResponse, $commitMsgResponse, $prePushResponse);
    }

    /**
     * @return ConfigurationDataResponse
     */
    public static function createAllEnabled()
    {
        return self::create(
            PreCommitResponseStub::createAllEnabled(),
            CommitMsgResponseStub::createEnabled(),
            PrePushResponseStub::createAllEnabled()
        );
    }

    /**
     * @param bool $preCommit
     * @param bool $commitMsg
     * @param bool $prePush
     *
     * @return ConfigurationDataResponse
     */
    public static function createCustom($preCommit, $commitMsg, $prePush)
    {
        return self::create(
            PreCommitResponseStub::create(
                $preCommit,
                PreCommitResponseStub::GOOD_JOB,
                PreCommitResponseStub::FIX_YOUR_CODE,
                $preCommit,
                $preCommit,
                $preCommit,
                PhpMdResponseStub::create($preCommit, PhpMdResponseStub::OPTIONS),
                PhpCsResponseStub::create($preCommit, PhpCsResponseStub::STANDARD),
                PhpCsFixerResponseStub::create($preCommit, $preCommit, $preCommit, $preCommit, $preCommit),
                PhpUnitResponseStub::create($preCommit, $preCommit, PhpUnitResponseStub::OPTIONS),
                PhpUnitStrictCoverageResponseStub::create($preCommit, PhpUnitStrictCoverageResponseStub::MINIMUM),
                PhpUnitGuardCoverageResponseStub::create($preCommit, PhpUnitGuardCoverageResponseStub::WARNING_MESSAGE)
            ),
            CommitMsgResponseStub::create($commitMsg, CommitMsgResponseStub::REGULAR_EXPRESSION),
            PrePushResponseStub::create(
                $prePush,
                PrePushResponseStub::RIGHT_MESSAGE,
                PrePushResponseStub::ERROR_MESSAGE,
                PhpUnitResponseStub::create($prePush, $prePush, PhpUnitResponseStub::OPTIONS),
                PhpUnitStrictCoverageResponseStub::create($prePush, PhpUnitStrictCoverageResponseStub::MINIMUM),
                PhpUnitGuardCoverageResponseStub::create($prePush, PhpUnitGuardCoverageResponseStub::WARNING_MESSAGE)
            )
        );
    }
}
