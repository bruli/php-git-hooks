<?php


namespace PhpGitHooks\Tests\Application\Composer;


use Composer\IO\IOInterface;
use Mockery\Mock;
use PhpGitHooks\Application\Composer\CommitMsgProcessor;

class CommitMsgProcessorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Mock */
    private $IO;
    /** @var  CommitMsgProcessor */
    private $commitMsgProcessor;

    protected function setUp()
    {
        $this->IO = \Mockery::mock(IOInterface::class);
        $this->commitMsgProcessor = new CommitMsgProcessor();
        $this->commitMsgProcessor->setIO($this->IO);
    }

    /**
     * @test
     */
    public function commitMsgEnabledHook()
    {
        $this->IO->shouldReceive('ask')->twice()->andReturn('y');

        $commitMsg = $this->commitMsgProcessor->execute([]);

        $this->assertArrayHasKey('commit-msg', $commitMsg);
        $this->assertTrue($commitMsg['commit-msg']['enabled']);
    }

    /**
     * @test
     */
    public function commitMsgDisabledHookWithoutData()
    {
        $this->IO->shouldReceive('ask')->once()->andReturn('n');

        $commitMsg = $this->commitMsgProcessor->execute([]);

        $this->assertArrayHasKey('commit-msg', $commitMsg);
        $this->assertFalse($commitMsg['commit-msg']['enabled']);
    }

    /**
     * @test
     */
    public function commitMsgDisabledHookWithData()
    {
        $commitMsg = $this->commitMsgProcessor->execute([
            'commit-msg' => [
                'enabled' => false
            ]
        ]);

        $this->assertArrayHasKey('commit-msg', $commitMsg);
        $this->assertFalse($commitMsg['commit-msg']['enabled']);
    }

    /**
     * @test
     */
    public function commitMsgExpressionRegular()
    {
        $this->IO->shouldReceive('ask')
            ->twice()
            ->andReturn('y', '#[0-9]{2,7}');

        $commitMsg = $this->commitMsgProcessor->execute([]);

        $this->assertSame('#[0-9]{2,7}', $commitMsg['commit-msg']['expression-regular']);
    }
}
