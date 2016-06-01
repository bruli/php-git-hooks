<?php

namespace Module\Configuration\Tests\Behaviour;

use Module\Configuration\Domain\CommitMsg;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsFixer;
use Module\Configuration\Domain\PhpUnit;
use Module\Configuration\Service\ConfigurationDataFinder;
use Module\Configuration\Tests\Infrastructure\ConfigurationUnitTestCase;
use Module\Configuration\Tests\Stub\ConfigArrayDataStub;

class ConfigurationDataFinderTest extends ConfigurationUnitTestCase
{
    /**
     * @var ConfigurationDataFinder
     */
    private $configurationDataFinder;

    protected function setUp()
    {
        $this->configurationDataFinder = new ConfigurationDataFinder(
            $this->getConfigurationFileReader()
        );
    }

    /**
     * @test
     */
    public function itShouldReturnEnabledTools()
    {
        $this->shouldReadConfigurationData(ConfigArrayDataStub::hooksEnabledWithEnabledTools());

        $data = $this->configurationDataFinder->find();

        $toolInterfaces = $data->getPreCommit()->getExecute()->execute();
        $composer = $toolInterfaces[0];
        $jsonLint = $toolInterfaces[1];
        $phpLint = $toolInterfaces[2];
        $phpMd = $toolInterfaces[3];
        /** @var PhpCs $phpCs */
        $phpCs = $toolInterfaces[4];
        /** @var PhpCsFixer $phpCsFixer */
        $phpCsFixer = $toolInterfaces[5];
        /** @var PhpUnit $phpUnit */
        $phpUnit = $toolInterfaces[6];

        $this->assertFalse($data->getPreCommit()->isUndefined());
        $this->assertTrue($data->getPreCommit()->isEnabled());

        $this->assertFalse($data->getCommitMsg()->isUndefined());
        $this->assertTrue($data->getCommitMsg()->isEnabled());

        $this->assertFalse($composer->isUndefined());
        $this->assertTrue($composer->isEnabled());

        $this->assertFalse($jsonLint->isUndefined());
        $this->assertTrue($jsonLint->isEnabled());

        $this->assertFalse($phpLint->isUndefined());
        $this->assertTrue($phpLint->isEnabled());

        $this->assertFalse($phpMd->isUndefined());
        $this->assertTrue($phpMd->isEnabled());

        $this->assertFalse($phpCs->isUndefined());
        $this->assertTrue($phpCs->isEnabled());
        $this->assertSame(ConfigArrayDataStub::PHPCS_STANDARD, $phpCs->getStandard()->value());

        $this->assertFalse($phpCsFixer->isUndefined());
        $this->assertTrue($phpCsFixer->isEnabled());
        $this->assertTrue($phpCsFixer->getLevels()->getPsr0()->value());
        $this->assertTrue($phpCsFixer->getLevels()->getPsr1()->value());
        $this->assertTrue($phpCsFixer->getLevels()->getPsr2()->value());
        $this->assertTrue($phpCsFixer->getLevels()->getSymfony()->value());

        $this->assertFalse($phpUnit->isUndefined());
        $this->assertTrue($phpUnit->isEnabled());
        $this->assertTrue($phpUnit->getRandomMode()->value());
        $this->assertSame(ConfigArrayDataStub::PHPUNIT_OPTIONS, $phpUnit->getOptions()->value());
    }
}
