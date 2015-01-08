<?php

namespace Infraestructure\Config;

use Mockery\Mock;
use PhpGitHooks\Infraestructure\Config\PreCommitConfig;
use PhpGitHooks\Infraestructure\Config\ConfigFileReader;

/**
 * Class PreCommitConfigTest
 * @package Infraestructure\Config
 */
class PreCommitConfigTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PreCommitConfig */
    private $preCommitConfig;
    /** @var  Mock */
    private $configFileReader;

    protected function setUp()
    {
        $this->configFileReader = \Mockery::mock(ConfigFileReader::class);
        $this->preCommitConfig = new PreCommitConfig($this->configFileReader);
    }

    /**
     * @test
     */
    public function invalidConfigData()
    {
        $data = ['pre-commit' =>
            ['execute' =>
                ['phpunit' => 'dfaa']
            ]
        ];

        $this->configFileReader->shouldReceive('getData')->andReturn($data);

        $this->assertFalse($this->preCommitConfig->isEnabled('phpunit'));
    }

    /**
     * @test
     */
    public function serviceNameNotExists()
    {
        $data = ['pre-commit' =>
            ['execute' =>
                ['phpunit' => true]
            ]
        ];

        $this->configFileReader->shouldReceive('getData')->andReturn($data);

        $this->assertFalse($this->preCommitConfig->isEnabled('servicename'));
    }

    /**
     *
     * @test
     */
    public function serviceIsEnabled()
    {
        $data = ['pre-commit' =>
            ['execute' =>
                ['phpunit' => true]
            ]
        ];

        $this->configFileReader->shouldReceive('getData')->andReturn($data);

        $this->assertTrue($this->preCommitConfig->isEnabled('phpunit'));
    }
}
