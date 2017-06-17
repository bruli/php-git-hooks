<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Git\Contract\Command\GitIgnoreWriter;
use PhpGitHooks\Module\Git\Contract\Command\GitIgnoreWriterHandler;
use PhpGitHooks\Module\Git\Tests\Infrastructure\GitUnitTestCase;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class GitIgnoreWriterHandlerTest extends GitUnitTestCase
{
    /**
     * @test
     */
    public function itShouldWriteData()
    {
        $content = StubCreator::faker()->text();

        $this->shouldWriteData($content);

        $commandHandler = new GitIgnoreWriterHandler($this->getWriter());
        $commandHandler->handle(new GitIgnoreWriter($content));
    }
}
