<?php

namespace Module\Git\Tests\Infrastructure;

use Module\Configuration\Domain\Config;
use Module\Configuration\Service\ConfigurationDataFinder;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

trait ConfigurationDataFinderTrait
{
    /**
     * @var ConfigurationDataFinder
     */
    private $configurationDataFinder;

    /**
     * @return \Mockery\MockInterface|ConfigurationDataFinder
     */
    protected function getConfigurationDataFinder()
    {
        return $this->configurationDataFinder = $this->configurationDataFinder ?: Mock::get(
            ConfigurationDataFinder::class
        );
    }

    /**
     * @param Config $return
     */
    protected function shouldFindConfigurationData(Config $return)
    {
        $this->getConfigurationDataFinder()
             ->shouldReceive('find')
             ->once()
             ->andReturn($return)
        ;
    }
}
