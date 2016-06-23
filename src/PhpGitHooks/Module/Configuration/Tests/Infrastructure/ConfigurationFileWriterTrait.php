<?php

namespace PhpGitHooks\Module\Configuration\Tests\Infrastructure;

use PhpGitHooks\Module\Configuration\Model\ConfigurationFileWriterInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait ConfigurationFileWriterTrait
{
    /**
     * @var ConfigurationFileWriterInterface
     */
    private $configurationFileWriter;

    /**
     * @return \Mockery\MockInterface|ConfigurationFileWriterInterface
     */
    protected function getConfigurationFileWriter()
    {
        return $this->configurationFileWriter = $this->configurationFileWriter ?: Mock::get(
            ConfigurationFileWriterInterface::class
        );
    }

    /**
     * @param array $configurationData
     */
    protected function shouldWriteConfigurationData(array $configurationData)
    {
        $this->getConfigurationFileWriter()
             ->shouldReceive('write')
             ->once()
             ->with($configurationData);
    }
}
