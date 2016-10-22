<?php

namespace PhpGitHooks\Module\Git\Contract\CommandHandler;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Git\Contract\Command\GitIgnoreWriterCommand;
use PhpGitHooks\Module\Git\Service\GitIgnoreWriter;

class GitIgnoreWriterCommandHandler implements CommandHandlerInterface
{
    /**
     * @var GitIgnoreWriter
     */
    private $gitIgnoreWriter;

    /**
     * GitIgnoreWriterCommandHandler constructor.
     *
     * @param GitIgnoreWriter $gitIgnoreWriter
     */
    public function __construct(GitIgnoreWriter $gitIgnoreWriter)
    {
        $this->gitIgnoreWriter = $gitIgnoreWriter;
    }

    /**
     * @param CommandInterface|GitIgnoreWriterCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->gitIgnoreWriter->write($command->getContent());
    }
}
