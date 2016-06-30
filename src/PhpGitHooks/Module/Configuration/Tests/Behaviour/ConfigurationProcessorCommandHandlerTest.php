<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Contract\Command\ConfigurationProcessorCommand;
use PhpGitHooks\Module\Configuration\Contract\CommandHandler\ConfigurationProcessorCommandHandler;
use PhpGitHooks\Module\Configuration\Service\CommitMsgProcessor;
use PhpGitHooks\Module\Configuration\Service\ConfigurationArrayTransformer;
use PhpGitHooks\Module\Configuration\Service\ConfigurationProcessor;
use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Service\PreCommitProcessor;
use PhpGitHooks\Module\Configuration\Service\PrePushProcessor;
use PhpGitHooks\Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use PhpGitHooks\Module\Configuration\Tests\Stub\CommitMsgStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigArrayDataStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\PreCommitStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\PrePushStub;

final class ConfigurationProcessorCommandHandlerTest extends ConfigurationUnitTestCase
{
    /**
     * @var ConfigurationProcessorCommandHandler
     */
    private $configurationProcessorCommandHandler;

    protected function setUp()
    {
        $this->configurationProcessorCommandHandler = new ConfigurationProcessorCommandHandler(
            new ConfigurationProcessor(
                $this->getConfigurationFileReader(),
                new PreCommitProcessor(),
                new CommitMsgProcessor(),
                $this->getConfigurationFileWriter(),
                $this->getHookCopier(),
                new PrePushProcessor()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldMakeAllQuestions()
    {
        $this->shouldReadConfigurationData(ConfigStub::createUndefined());

        $yes = 'y';
        $this->shouldAsk(HookQuestions::PRE_COMMIT_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(
            HookQuestions::PRE_COMMIT_RIGHT_MESSAGE,
            HookQuestions::PRE_COMMIT_RIGHT_MESSAGE_DEFAULT,
            ConfigArrayDataStub::RIGHT_MESSAGE
        );
        $this->shouldAsk(
            HookQuestions::PRE_COMMIT_ERROR_MESSAGE,
            HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT,
            ConfigArrayDataStub::ERROR_MESSAGE
        );
        $this->shouldAsk(HookQuestions::COMPOSER_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::JSONLINT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPLINT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPMD_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPMD_OPTIONS, null, ConfigArrayDataStub::PHPMD_OPTIONS);
        $this->shouldAsk(HookQuestions::PHPCS_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPCS_STANDARD, null, ConfigArrayDataStub::PHPCS_STANDARD);
        $this->shouldAsk(HookQuestions::PHPCSFIXER_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPCSFIXER_PSR0_LEVEL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPCSFIXER_PSR1_LEVEL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPCSFIXER_PSR2_LEVEL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPCSFIXER_SYMFONY_LEVEL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPUNIT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPUNIT_RANDOM_MODE, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPUNIT_OPTIONS, null, ConfigArrayDataStub::PHPUNIT_OPTIONS);
        $this->shouldAsk(HookQuestions::PHPUNIT_STRICT_COVERAGE, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPUNIT_STRICT_COVERAGE_MINIMUM, 0.00, ConfigArrayDataStub::MINIMUM_COVERAGE);
        $this->shouldAsk(HookQuestions::PHPUNIT_GUARD_COVERAGE, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(
            HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE,
            HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE_DEFAULT,
            ConfigArrayDataStub::ERROR_MESSAGE
        );
        $this->shouldAsk(HookQuestions::COMMIT_MSG_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldCopyPreCommitHook();
        $this->shouldAsk(
            HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION,
            HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION_ANSWER,
            ConfigArrayDataStub::REGULAR_EXPRESSION
        );
        $this->shouldCopyCommitMsgHook();
        $this->shouldAsk(HookQuestions::PRE_PUSH_HOOK_QUESTION, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(
            HookQuestions::PRE_PUSH_RIGHT_MESSAGE,
            HookQuestions::PRE_PUSH_RIGHT_MESSAGE_DEFAULT,
            HookQuestions::PRE_PUSH_RIGHT_MESSAGE_DEFAULT
        );
        $this->shouldAsk(
            HookQuestions::PRE_PUSH_ERROR_MESSAGE,
            HookQuestions::PRE_PUSH_ERROR_MESSAGE_DEFAULT,
            HookQuestions::PRE_PUSH_ERROR_MESSAGE_DEFAULT
        );
        $this->shouldAsk(HookQuestions::PHPUNIT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPUNIT_RANDOM_MODE, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPUNIT_OPTIONS, null, ConfigArrayDataStub::PHPUNIT_OPTIONS);
        $this->shouldAsk(HookQuestions::PHPUNIT_STRICT_COVERAGE, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(HookQuestions::PHPUNIT_STRICT_COVERAGE_MINIMUM, 0.00, ConfigArrayDataStub::MINIMUM_COVERAGE);
        $this->shouldAsk(HookQuestions::PHPUNIT_GUARD_COVERAGE, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldAsk(
            HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE,
            HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE_DEFAULT,
            ConfigArrayDataStub::ERROR_MESSAGE
        );
        $this->shouldCopyPrePushHook();
        $this->shouldWriteConfigurationData(ConfigArrayDataStub::hooksEnabledWithEnabledTools());

        $command = new ConfigurationProcessorCommand($this->getIOInterface());

        $this->configurationProcessorCommandHandler->handle($command);
    }

    /**
     * @test
     */
    public function itShouldNotMakeAnyQuestions()
    {
        $data = ConfigurationArrayTransformer::transform(
            PreCommitStub::createAllEnabled(),
            CommitMsgStub::createEnabled(),
            PrePushStub::createAllEnabled()
        );

        $this->shouldReadConfigurationData(ConfigStub::createEnabled());
        $this->shouldCopyPreCommitHook();
        $this->shouldCopyCommitMsgHook();
        $this->shouldCopyPrePushHook();
        $this->shouldWriteConfigurationData($data);

        $command = new ConfigurationProcessorCommand($this->getIOInterface());

        $this->configurationProcessorCommandHandler->handle($command);
    }
}
