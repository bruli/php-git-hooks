<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\CommandHandler;

use CommandBus\CommandBus\CommandHandlerInterface;
use CommandBus\CommandBus\CommandInterface;
use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverageCommand;
use PhpGitHooks\Module\PhpUnit\Service\StrictCoverageToolExecutor;

class StrictCoverageToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var StrictCoverageToolExecutor
     */
    private $strictCoverageToolExecutor;

    /**
     * StrictCoverageToolCommandHandler constructor.
     *
     * @param StrictCoverageToolExecutor $strictCoverageToolExecutor
     */
    public function __construct(StrictCoverageToolExecutor $strictCoverageToolExecutor)
    {
        $this->strictCoverageToolExecutor = $strictCoverageToolExecutor;
    }

    /**
     * @param CommandInterface|StrictCoverageCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->strictCoverageToolExecutor->execute(
            new MinimumStrictCoverage($command->getMinimumCoverage()),
            $command->getErrorMessage()
        );
    }
}
