<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\PhpGuardCoverageGitIgnoreConfigurator;
use PhpGitHooks\Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use PhpGitHooks\Module\Git\Contract\Command\GitIgnoreWriterCommand;
use PhpGitHooks\Module\Git\Contract\Query\GitIgnoreExtractorQuery;
use PhpGitHooks\Module\Git\Tests\Stub\GitIgnoreDataResponseStub;

class PhpGuardCoverageGitIgnoreConfiguratorTest extends ConfigurationUnitTestCase
{
    /**
     * @var PhpGuardCoverageGitIgnoreConfigurator
     */
    private $phpGuardCoverageGitIgnoreConfigurator;

    protected function setUp()
    {
        $this->phpGuardCoverageGitIgnoreConfigurator = new PhpGuardCoverageGitIgnoreConfigurator(
            $this->getQueryBus(),
            $this->getCommandBus()
        );
    }

    /**
     * @test
     */
    public function itShouldWriteEntry()
    {
        $content = GitIgnoreDataResponseStub::random();

        $this->shouldHandleQuery(new GitIgnoreExtractorQuery(), $content);
        $this->shouldHandleCommand(new GitIgnoreWriterCommand($content->getContent()));

        $this->phpGuardCoverageGitIgnoreConfigurator->configure();
    }
    /**
     * @test
     */
    public function itShouldNotWriteEntry()
    {
        $this->shouldHandleQuery(new GitIgnoreExtractorQuery(), GitIgnoreDataResponseStub::randomWithGuardCoverage());

        $this->phpGuardCoverageGitIgnoreConfigurator->configure();
    }
}
