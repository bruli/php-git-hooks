<?php

namespace Module\PhpCsFixer\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\PhpCsFixer\Contract\Command\PhpCsFixerToolCommand;
use Module\PhpCsFixer\Service\PhpCsFixerTool;

class PhpCsFixerToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PhpCsFixerTool
     */
    private $phpCsFixerTool;

    /**
     * PhpCsFixerToolCommandHandler constructor.
     *
     * @param PhpCsFixerTool $phpCsFixerTool
     */
    public function __construct(PhpCsFixerTool $phpCsFixerTool)
    {
        $this->phpCsFixerTool = $phpCsFixerTool;
    }

    /**
     * @param CommandInterface|PhpCsFixerToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->phpCsFixerTool->execute(
            $command->getFiles(),
            $command->isPsr0(),
            $command->isPsr1(),
            $command->isPsr2(),
            $command->isSymfony(),
            $command->getErrorMessage()
        );
    }
}
