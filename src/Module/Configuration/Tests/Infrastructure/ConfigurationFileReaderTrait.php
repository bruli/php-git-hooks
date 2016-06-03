<?php

namespace Module\Configuration\Tests\Infrastructure;

use Module\Configuration\Model\ConfigurationFileReaderInterface;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

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
