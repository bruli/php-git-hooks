<?php

namespace Module\Configuration\Tests\Behaviour;

use Composer\IO\IOInterface;
use Module\Configuration\Domain\Execute;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsFixer;
use Module\Configuration\Domain\PhpUnit;
use Module\Configuration\Service\HookQuestions;
use Module\Configuration\Service\PreCommitProcessor;
use Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use Module\Configuration\Tests\Stub\PreCommitStub;

class PreCommitProcessorTest extends ConfigurationUnitTestCase
{
    /**
     * @var PreCommitProcessor
     */
    private $preCommitProcessor;
    /**
     * @var IOInterface
     */
    private $io;

    protected function setUp()
    {
        $this->io = $this->getIOInterface();
        $this->preCommitProcessor = new PreCommitProcessor();
    }

    /**
     * @test
     */
    public function itShouldDisablePreCommitHook()
    {
        $this->shouldAsk(HookQuestions::PRE_COMMIT_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER, 'n');

        $preCommitData = $this->preCommitProcessor->process(PreCommitStub::createUndefined(), $this->io);

        $this->assertFalse($preCommitData->isEnabled());
        $this->assertFalse($preCommitData->isUndefined());
        $this->assertNull($preCommitData->getMessages()->getRightMessage()->value());
        $this->assertNull($preCommitData->getMessages()->getErrorMessage()->value());

        /** @var Execute $execute */
        $execute = $preCommitData->getExecute();
        $tools = $execute->execute();

        $composer = $tools[0];
        $jsonLint = $tools[1];
        $phpLint = $tools[2];

        $this->assertFalse($composer->isEnabled());
        $this->assertFalse($composer->isUndefined());
        $this->assertFalse($jsonLint->isEnabled());
        $this->assertFalse($jsonLint->isUndefined());
        $this->assertFalse($phpLint->isEnabled());
        $this->assertFalse($phpLint->isUndefined());
    }

    /**
     * @test
     */
    public function itShouldEnablePreCommitButDisableTools()
    {
        $negativeAnswer = 'n';

        $this->shouldAsk(HookQuestions::PRE_COMMIT_HOOK, HookQuestions::DEFAULT_TOOL_ANSWER, 'y');
        $this->shouldAsk(
            HookQuestions::PRE_COMMIT_RIGHT_MESSAGE,
            HookQuestions::PRE_COMMIT_RIGHT_MESSAGE_DEFAULT,
            HookQuestions::PRE_COMMIT_RIGHT_MESSAGE_DEFAULT
        );
        $this->shouldAsk(
            HookQuestions::PRE_COMMIT_ERROR_MESSAGE,
            HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT,
            HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT
        );
        $this->shouldAsk(HookQuestions::JSONLINT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $negativeAnswer);
        $this->shouldAsk(HookQuestions::COMPOSER_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $negativeAnswer);
        $this->shouldAsk(HookQuestions::PHPLINT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $negativeAnswer);
        $this->shouldAsk(HookQuestions::PHPMD_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $negativeAnswer);
        $this->shouldAsk(HookQuestions::PHPCS_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $negativeAnswer);
        $this->shouldAsk(HookQuestions::PHPCSFIXER_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $negativeAnswer);
        $this->shouldAsk(HookQuestions::PHPUNIT_TOOL, HookQuestions::DEFAULT_TOOL_ANSWER, $negativeAnswer);

        $preCommitData = $this->preCommitProcessor->process(PreCommitStub::createUndefined(), $this->io);

        $this->assertTrue($preCommitData->isEnabled());
        $this->assertSame(
            HookQuestions::PRE_COMMIT_RIGHT_MESSAGE_DEFAULT,
            $preCommitData->getMessages()->getRightMessage()->value()
        );

        /** @var Execute $execute */
        $execute = $preCommitData->getExecute();
        $tools = $execute->execute();
        $composer = $tools[0];
        $jsonLint = $tools[1];
        $phpLint = $tools[2];
        $phpMd = $tools[3];
        $phpCs = $tools[4];
        $phpCsFixer = $tools[5];
        $phpUnit = $tools[6];

        $this->assertFalse($composer->isEnabled());
        $this->assertFalse($composer->isUndefined());
        $this->assertFalse($jsonLint->isEnabled());
        $this->assertFalse($jsonLint->isUndefined());
        $this->assertFalse($phpLint->isEnabled());
        $this->assertFalse($phpLint->isUndefined());
        $this->assertFalse($phpMd->isEnabled());
        $this->assertFalse($phpMd->isUndefined());
        $this->assertFalse($phpCs->isEnabled());
        $this->assertFalse($phpCs->isUndefined());
        $this->assertFalse($phpCsFixer->isEnabled());
        $this->assertFalse($phpCsFixer->isUndefined());
        $this->assertFalse($phpUnit->isEnabled());
        $this->assertFalse($phpUnit->isUndefined());
    }

    /**
     * @test
     */
    public function itShouldNotSetAnyQuestion()
    {
        $this->preCommitProcessor->process(PreCommitStub::random(), $this->getIOInterface());
    }
}
