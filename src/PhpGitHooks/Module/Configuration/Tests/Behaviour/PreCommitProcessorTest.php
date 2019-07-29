<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Execute;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;
use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Service\PhpGuardCoverageGitIgnoreConfigurator;
use PhpGitHooks\Module\Configuration\Service\PhpUnitGuardCoverageConfigurator;
use PhpGitHooks\Module\Configuration\Service\PreCommitProcessor;
use PhpGitHooks\Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use PhpGitHooks\Module\Configuration\Tests\Stub\PreCommitStub;

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
        $this->preCommitProcessor = new PreCommitProcessor(
            new PhpUnitGuardCoverageConfigurator(
                new PhpGuardCoverageGitIgnoreConfigurator(
                    $this->getQueryBus(),
                    $this->getCommandBus()
                )
            )
        );
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
        $this->assertTrue($preCommitData->getMessages()->getEnableFaces()->value());

        /** @var Execute $execute */
        $execute = $preCommitData->getExecute();
        $tools = $execute->execute();

        $composer = $tools[0];
        $jsonLint = $tools[1];
        $phpLint = $tools[2];
        /** @var PhpUnitStrictCoverage $phpunitStrictCoverage */
        $phpunitStrictCoverage = $tools[7];

        $this->assertFalse($composer->isEnabled());
        $this->assertFalse($composer->isUndefined());
        $this->assertFalse($jsonLint->isEnabled());
        $this->assertFalse($jsonLint->isUndefined());
        $this->assertFalse($phpLint->isEnabled());
        $this->assertFalse($phpLint->isUndefined());
        $this->assertFalse($phpunitStrictCoverage->isUndefined());
    }
}
