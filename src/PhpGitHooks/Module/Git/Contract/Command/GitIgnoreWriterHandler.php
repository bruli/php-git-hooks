<?php

namespace PhpGitHooks\Module\Git\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Git\Model\WriterInterface;

class GitIgnoreWriterHandler implements CommandHandlerInterface
{
    /**
     * @var WriterInterface
     */
    private $gitIgnoreWriter;

    /**
     * GitIgnoreWriter constructor.
     *
     * @param WriterInterface $gitIgnoreWriter
     */
    public function __construct(WriterInterface $gitIgnoreWriter)
    {
        $this->gitIgnoreWriter = $gitIgnoreWriter;
    }

    /**
     * @param string $content
     */
    private function write($content)
    {
        $this->gitIgnoreWriter->write($content);
    }

    /**
     * @param CommandInterface|GitIgnoreWriter $command
     */
    public function handle(CommandInterface $command)
    {
        $this->write($command->getContent());
    }
}
