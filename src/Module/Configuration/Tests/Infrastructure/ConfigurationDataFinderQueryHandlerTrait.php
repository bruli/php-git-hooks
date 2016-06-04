<?php

namespace Module\Configuration\Tests\Infrastructure;

use Module\Configuration\Contract\QueryHandler\ConfigurationDataFinderQueryHandler;
use Module\Configuration\Contract\Response\ConfigurationDataResponse;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

trait ConfigurationDataFinderQueryHandlerTrait
{
    /**
     * @var ConfigurationDataFinderQueryHandler
     */
    private $configurationDataFinderQueryHandler;

    /**
     * @return \Mockery\MockInterface|ConfigurationDataFinderQueryHandler
     */
    protected function getConfigurationDataFinderQueryHandler()
    {
        return $this->configurationDataFinderQueryHandler = $this->configurationDataFinderQueryHandler ?: Mock::get(
            ConfigurationDataFinderQueryHandler::class
        );
    }

    /**
     * @param ConfigurationDataResponse $return
     */
    protected function shouldHandleConfigurationDataQuery(ConfigurationDataResponse $return)
    {
        $this->getConfigurationDataFinderQueryHandler()
             ->shouldReceive('handle')
             ->once()
             ->andReturn($return)
        ;
    }
}
