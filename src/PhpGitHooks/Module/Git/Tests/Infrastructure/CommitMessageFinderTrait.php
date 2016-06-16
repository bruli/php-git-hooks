<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Model\CommitMessageFinderInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait CommitMessageFinderTrait
{
    /**
     * @var CommitMessageFinderInterface
     */
    private $commitMessageFinder;

    /**
     * @return \Mockery\MockInterface|CommitMessageFinderInterface
     */
    protected function getCommitMessageFinder()
    {
        return $this->commitMessageFinder = $this->commitMessageFinder ?: Mock::get(
            CommitMessageFinderInterface::class
        );
    }

    /**
     * @param string $file
     * @param string $return
     */
    protected function shouldFindCommitMessage($file, $return)
    {
        $this->getCommitMessageFinder()
            ->shouldReceive('find')
            ->once()
            ->with($file)
            ->andReturn($return);
    }
}
