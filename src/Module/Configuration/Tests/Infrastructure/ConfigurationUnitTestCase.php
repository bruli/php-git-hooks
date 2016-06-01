<?php

namespace Module\Configuration\Tests\Infrastructure;

use Composer\IO\IOInterface;
use Module\Configuration\Infrastructure\Hook\HookCopier;
use Module\Configuration\Model\ConfigurationFileReaderInterface;
use Module\Configuration\Model\ConfigurationFileWriterInterface;
use Module\Tests\Infrastructure\UnitTestCase\BaseUnitTestCase;

abstract class ConfigurationUnitTestCase extends BaseUnitTestCase
{
    /**
     * @var ConfigurationFileReaderInterface
     */
    private $configurationFileReader;
    /**
     * @var IOInterface
     */
    private $ioInterface;
    /**
     * @var ConfigurationFileWriterInterface
     */
    private $configurationFileWriter;
    /**
     * @var HookCopier
     */
    private $hookCopier;

    /**
     * @return \Mockery\MockInterface|ConfigurationFileReaderInterface
     */
    protected function getConfigurationFileReader()
    {
        return $this->configurationFileReader = $this->configurationFileReader ?:
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
     * @return \Mockery\MockInterface|ConfigurationFileWriterInterface
     */
    protected function getConfigurationFileWriter()
    {
        return $this->configurationFileWriter = $this->configurationFileWriter ?: $this->mock(
            ConfigurationFileWriterInterface::class
        );
    }

    /**
     * @return \Mockery\MockInterface|HookCopier
     */
    protected function getHookCopier()
    {
        return $this->hookCopier = $this->hookCopier ?: $this->mock(HookCopier::class);
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
             ->andReturn($return)
        ;
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

    protected function shouldCopyPreCommitHook()
    {
        $this->getHookCopier()
            ->shouldReceive('copyPreCommitHook')
            ->once();
    }
    
    protected function shouldCopyCommitMsgHook()
    {
        $this->getHookCopier()
            ->shouldReceive('copyCommitMsgHook')
            ->once();
    }
}
