<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Git\Contract\Command\GitIgnoreWriterCommand;
use PhpGitHooks\Module\Git\Contract\CommandHandler\GitIgnoreWriterCommandHandler;
use PhpGitHooks\Module\Git\Service\GitIgnoreWriter;
use PhpGitHooks\Module\Git\Tests\Infrastructure\GitUnitTestCase;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class GitIgnoreWriterCommandHandlerTest extends GitUnitTestCase
{
    /**
     * @test
     */
    public function itShouldWriteData()
    {
        $content = StubCreator::faker()->text();

        $this->shouldWriteData($content);

        $commandHandler = new GitIgnoreWriterCommandHandler(
            new GitIgnoreWriter($this->getWriter())
        );
        $commandHandler->handle(new GitIgnoreWriterCommand($content));
    }
}
