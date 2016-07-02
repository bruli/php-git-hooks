<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\CommandHandler;

use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandHandlerInterface;
use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandInterface;
use PhpGitHooks\Module\PhpUnit\Contract\Command\GuardCoverageCommand;
use PhpGitHooks\Module\PhpUnit\Service\GuardCoverageTool;

class GuardCoverageToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var GuardCoverageTool
     */
    private $guardCoverageTool;

    /**
     * GuardCoverageToolCommandHandler constructor.
     *
     * @param GuardCoverageTool $guardCoverageTool
     */
    public function __construct(GuardCoverageTool $guardCoverageTool)
    {
        $this->guardCoverageTool = $guardCoverageTool;
    }

    /**
     * @param CommandInterface|GuardCoverageCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->guardCoverageTool->run($command->getWarningMessage());
    }
}
