<?php

namespace PhpGitHooks\Tests\Application\Composer;

use Mockery\Mock;
use PhpGitHooks\Application\Composer\CommitMsgProcessor;

/**
 * Class CommitMsgProcessorTest
 * @package PhpGitHooks\Tests\Application\Composer
 */
class CommitMsgProcessorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CommitMsgProcessor */
    private $commitMsgProcessor;
    /** @var  Mock */
    private $hooksFileCopier;
    /** @var  Mock */
    private $iOinterface;

    protected function setUp()
    {
        $this->hooksFileCopier = \Mockery::mock('PhpGitHooks\Infrastructure\Git\HooksFileCopier');
        $this->iOinterface = \Mockery::mock('Composer\IO\IOInterface');

        $this->commitMsgProcessor = new CommitMsgProcessor($this->hooksFileCopier);
        $this->commitMsgProcessor->setIO($this->iOinterface);
    }

    /**
     * @test
     */
    public function isDisabled()
    {
        $this->iOinterface->shouldReceive('ask')->andReturn('n');
        $data = $this->commitMsgProcessor->execute();

        $this->assertFalse($data['commit-msg']['enabled']);
    }

    /**
     * @test
     */
    public function isEnabled()
    {
        $this->iOinterface->shouldReceive('ask')->andReturn('y');
        $this->hooksFileCopier->shouldReceive('copy');
        $data = $this->commitMsgProcessor->execute();

        $this->assertTrue($data['commit-msg']['enabled']);
    }
}
