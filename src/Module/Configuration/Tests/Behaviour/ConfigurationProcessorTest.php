<?php

namespace Module\Configuration\Tests\Behaviour;

use Module\Configuration\Service\CommitMsgProcessor;
use Module\Configuration\Service\ConfigurationDataFinder;
use Module\Configuration\Service\ConfigurationProcessor;
use Module\Configuration\Service\HookQuestions;
use Module\Configuration\Service\PreCommitProcessor;
use Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use Module\Configuration\Tests\Stub\ConfigArrayDataStub;

final class ConfigurationProcessorTest extends ConfigurationUnitTestCase
{
    /**
     * @var ConfigurationProcessor
     */
    private $configurationProcessor;

    protected function setUp()
    {
        $this->configurationProcessor = new ConfigurationProcessor(
            new ConfigurationDataFinder($this->getConfigurationFileReader()),
            new PreCommitProcessor(),
            new CommitMsgProcessor(),
            $this->getConfigurationFileWriter(),
            $this->getHookCopier()
        );
    }

    /**
     * @test
     */
    public function itShouldMakeAllQuestions()
    {
        $this->shouldReadConfigurationData([]);

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
        $this->shouldAsk(HookQuestions::COMMIT_MSG_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER, $yes);
        $this->shouldCopyPreCommitHook();
        $this->shouldAsk(
            HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION,
            HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION_ANSWER,
            ConfigArrayDataStub::REGULAR_EXPRESSION
        );
        $this->shouldCopyCommitMsgHook();

        $this->shouldWriteConfigurationData(ConfigArrayDataStub::hooksEnabledWithEnabledTools());

        $this->configurationProcessor->process($this->getIOInterface());
    }

    /**
     * @test
     */
    public function itShouldMakeAnyQuestions()
    {
        $data = ConfigArrayDataStub::hooksEnabledWithEnabledTools();
        $this->shouldReadConfigurationData($data);
        $this->shouldCopyPreCommitHook();
        $this->shouldCopyCommitMsgHook();
        $this->shouldWriteConfigurationData($data);

        $this->configurationProcessor->process($this->getIOInterface());
    }
}
