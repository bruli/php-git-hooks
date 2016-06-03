<?php

namespace Module\Git\Tests\Behaviour;

use Module\Git\Service\PreCommitTool;
use Module\Git\Tests\Infrastructure\GitUnitTestCase;

final class PreCommitToolTest extends GitUnitTestCase
{
    /**
     * @var PreCommitTool
     */
    private $preCommitTool;

    protected function setUp()
    {
        $this->preCommitTool = new PreCommitTool(
            $this->getConfigurationDataFinder(),
            $this->getFilesCommittedExtractor()
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTools()
    {
        $this->shouldGetFilesCommitted([]);
        $this->preCommitTool->execute($this->getOutputInterface());
    }

    /**
     * @test
     */
    public function itShouldExecuteWithComposerFiles()
    {
    }
}
