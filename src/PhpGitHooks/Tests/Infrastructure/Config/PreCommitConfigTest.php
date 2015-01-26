<?php

namespace PhpGitHooks\Tests\Infrastructure\Config;

use Mockery\Mock;
use PhpGitHooks\Infrastructure\Config\PreCommitConfig;

/**
 * Class PreCommitConfigTest
 * @package Infrastructure\Config
 */
class PreCommitConfigTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PreCommitConfig */
    private $preCommitConfig;
    /** @var  Mock */
    private $configFileReader;

    protected function setUp()
    {
        $this->configFileReader = \Mockery::mock('PhpGitHooks\Infrastructure\Config\ConfigFileReader');
        $this->preCommitConfig = new PreCommitConfig($this->configFileReader);
    }

    /**
     * @test
     */
    public function invalidConfigData()
    {
        $data = ['pre-commit' => ['execute' => ['phpunit' => 'dfaa'],
            ],
        ];

        $this->configFileReader->shouldReceive('getData')->andReturn($data);

        $this->assertFalse($this->preCommitConfig->isEnabled('phpunit'));
    }

    /**
     * @test
     */
    public function serviceNameNotExists()
    {
        $data = ['pre-commit' => ['execute' => ['phpunit' => true],
            ],
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
        $data = ['pre-commit' => ['execute' => ['phpunit' => true],
            ],
        ];

        $this->configFileReader->shouldReceive('getData')->andReturn($data);

        $this->assertTrue($this->preCommitConfig->isEnabled('phpunit'));
    }
}
