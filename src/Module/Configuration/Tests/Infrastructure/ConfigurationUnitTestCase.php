<?php

namespace Module\Configuration\Tests\Infrastructure;

use Composer\IO\IOInterface;
use Module\Configuration\Model\ConfigurationFileReaderInterface;
use Module\Tests\Infrastructure\UnitTestCase\BaseUnitTestCase;

abstract class ConfigurationUnitTestCase extends BaseUnitTestCase
{
    /**
     * @var ConfigurationFileReaderInterface
     */
    private $configuratorFileReader;
    /**
     * @var IOInterface
     */
    private $ioInterface;

    /**
     * @return \Mockery\MockInterface|ConfigurationFileReaderInterface
     */
    protected function getConfiguratorFileReader()
    {
        return $this->configuratorFileReader = $this->configuratorFileReader ?:
            $this->mock(ConfigurationFileReaderInterface::class);
    }

    /**
     * @return \Mockery\MockInterface|IOInterface
     */
    protected function getIOInterface()
    {
        return $this->ioInterface = $this->ioInterface ?: $this->mock(IOInterface::class);
    }

    /**
     * @param array $return
     */
    protected function shouldReadConfigurationData(array $return)
    {
        $this->getConfiguratorFileReader()
            ->shouldReceive('getData')
            ->once()
            ->andReturn($return);
    }

    /**
     * @param string $question
     * @param string $default
     * @param string $return
     */
    protected function shouldAsk($question, $default, $return)
    {
        $this->getIOInterface()
            ->shouldReceive('ask')
            ->once()
            ->withArgs([$question, $default])
            ->andReturn($return);
    }
}
