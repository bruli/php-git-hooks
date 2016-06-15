<?php

namespace PhpGitHooks\Module\Configuration\Tests\Infrastructure;

use PhpGitHooks\Module\Configuration\Model\ConfigurationFileReaderInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait ConfigurationFileReaderTrait
{
    /**
     * @var ConfigurationFileReaderInterface
     */
    private $configurationFileReader;

    /**
     * @return \Mockery\MockInterface|ConfigurationFileReaderInterface
     */
    protected function getConfigurationFileReader()
    {
        return $this->configurationFileReader = $this->configurationFileReader ?:
            Mock::get(ConfigurationFileReaderInterface::class);
    }

    /**
     * @param array $return
     */
    protected function shouldReadConfigurationData(array $return)
    {
        $this->getConfigurationFileReader()
             ->shouldReceive('getData')
             ->once()
             ->andReturn($return)
        ;
    }
}
