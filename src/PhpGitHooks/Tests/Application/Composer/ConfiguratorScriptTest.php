<?php

namespace PhpGitHooks\Tests\Application\Composer;

use PhpGitHooks\Application\Composer\ConfiguratorScript;
use Mockery\Mock;

/**
 * Class ConfiguratorScriptTest.
 */
class ConfiguratorScriptTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Mock */
    private $event;

    protected function setUp()
    {
        $this->event = \Mockery::mock('Composer\Script\Event');
    }

    /**
     * @test
     */
    public function buildConfigStopInProdMode()
    {
        $this->event->shouldReceive('isDevMode')->andReturn(false);
        $configurator = ConfiguratorScript::buildConfig($this->event);

        $this->assertNull($configurator);
    }

    /**
     * @test
     */
    public function buildConfigReturnsProcess()
    {
        $iO = \Mockery::mock('Composer\IO\IOInterface');
        $iO->shouldReceive('ask');

        $this->event->shouldReceive('isDevMode')->andReturn(true);
        $this->event->shouldReceive('getIO')->andReturn($iO);

        $buildConfig = ConfiguratorScript::buildConfig($this->event);
        $this->assertTrue($buildConfig);
    }
}
