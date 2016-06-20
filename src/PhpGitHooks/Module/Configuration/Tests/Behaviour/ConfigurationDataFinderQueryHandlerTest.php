<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinderQuery;
use PhpGitHooks\Module\Configuration\Contract\QueryHandler\ConfigurationDataFinderQueryHandler;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Configuration\Service\ConfigurationDataFinder;
use PhpGitHooks\Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use PhpGitHooks\Module\Configuration\Tests\Stub\CommitMsgStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\PreCommitStub;

class ConfigurationDataFinderQueryHandlerTest extends ConfigurationUnitTestCase
{
    /**
     * @var ConfigurationDataFinderQueryHandler
     */
    private $configurationDataFinderQueryHandler;

    protected function setUp()
    {
        $this->configurationDataFinderQueryHandler = new ConfigurationDataFinderQueryHandler(
            new ConfigurationDataFinder(
                $this->getConfigurationFileReader()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldReturnEnabledTools()
    {
        $this->shouldReadConfigurationData(ConfigStub::create(
            PreCommitStub::createAllEnabled(),
            CommitMsgStub::createEnabled()
        ));

        /** @var ConfigurationDataResponse $data */
        $data = $this->configurationDataFinderQueryHandler->handle(new ConfigurationDataFinderQuery());

        $this->assertTrue($data->isPreCommit());
        $this->assertNotNull($data->getRightMessage());
        $this->assertNotNull($data->getErrorMessage());
        $this->assertTrue($data->isCommitMsg());
        $this->assertTrue($data->isComposer());
        $this->assertTrue($data->isJsonLint());
        $this->assertTrue($data->isPhpLint());
        $this->assertTrue($data->isPhpMd());
        $this->assertTrue($data->isPhpCs());
        $this->assertNotNull($data->getPhpCsStandard());
        $this->assertTrue($data->isPhpCsFixer());
        $this->assertTrue($data->isPhpCsFixerPsr0());
        $this->assertTrue($data->isPhpCsFixerPsr1());
        $this->assertTrue($data->isPhpCsFixerPsr2());
        $this->assertTrue($data->isPhpCsFixerSymfony());
        $this->assertTrue($data->isPhpunit());
        $this->assertTrue($data->isPhpunitRandomMode());
        $this->assertNotNull($data->getPhpunitOptions());
    }
}
