<?php

namespace PhpGitHooks\Tests\Infrastructure\Config;

use PhpGitHooks\Application\Config\PreCommitConfig;
use PhpGitHooks\Infrastructure\Config\InMemoryFileReader;

/**
 * Class PreCommitConfigTest.
 */
class PreCommitConfigTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PreCommitConfig */
    private $preCommitConfig;
    /** @var  InMemoryFileReader */
    private $configFileReader;

    protected function setUp()
    {
        $this->configFileReader = new InMemoryFileReader();
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

        $this->configFileReader->setData($data);

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

        $this->configFileReader->setData($data);

        $this->assertFalse($this->preCommitConfig->isEnabled('servicename'));
    }

    /**
     * @test
     */
    public function serviceIsEnabled()
    {
        $data = ['pre-commit' => ['execute' => ['phpunit' => true],
            ],
        ];

        $this->configFileReader->setData($data);

        $this->assertTrue($this->preCommitConfig->isEnabled('phpunit'));
    }
}
