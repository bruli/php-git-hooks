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
    public function itShouldReturnEnabledHooks()
    {
        $this->shouldReadConfigurationData(ConfigArrayDataStub::hooksEnabledWithoutTools());

        $data = $this->configurationDataFinder->find();

        /** @var CommitMsg $commitMsg */
        $commitMsg = $data->getCommitMsg();
        $this->assertFalse($commitMsg->isUndefined());
        $this->assertTrue($commitMsg->isEnabled());
        $this->assertNotNull($commitMsg->getRegularExpression()->value());

        $this->assertFalse($data->getPreCommit()->isUndefined());
        $this->assertTrue($data->getPreCommit()->isEnabled());
    }

    public function configHookArrayProvider()
    {
        return [
            [[]],
            [ConfigArrayDataStub::hooksEnabledWithoutTools()],
        ];
    }

    /**
     * @test
     * @dataProvider configHookArrayProvider
     *
     * @param array $dataFromProvider
     */
    public function itShouldReturnUndefinedPreCommitTools(array $dataFromProvider)
    {
        $this->shouldReadConfigurationData($dataFromProvider);

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

        $this->assertTrue($composer->isUndefined());
        $this->assertFalse($composer->isEnabled());

        $this->assertTrue($jsonLint->isUndefined());
        $this->assertFalse($jsonLint->isEnabled());

        $this->assertTrue($phpLint->isUndefined());
        $this->assertFalse($phpLint->isEnabled());

        $this->assertTrue($phpMd->isUndefined());
        $this->assertFalse($phpMd->isEnabled());

        $this->assertTrue($phpCs->isUndefined());
        $this->assertFalse($phpCs->isEnabled());
        $this->assertNull($phpCs->getStandard()->value());

        $this->assertTrue($phpCsFixer->isUndefined());
        $this->assertFalse($phpCsFixer->isEnabled());
        $this->assertFalse($phpCsFixer->getLevels()->getPsr0()->value());
        $this->assertFalse($phpCsFixer->getLevels()->getPsr1()->value());
        $this->assertFalse($phpCsFixer->getLevels()->getPsr2()->value());
        $this->assertFalse($phpCsFixer->getLevels()->getSymfony()->value());

        $this->assertTrue($phpUnit->isUndefined());
        $this->assertFalse($phpUnit->isEnabled());
        $this->assertFalse($phpUnit->getRandomMode()->value());
        $this->assertNull($phpUnit->getOptions()->value());
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
