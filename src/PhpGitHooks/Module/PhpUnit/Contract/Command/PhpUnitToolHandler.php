<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpUnit\Contract\Exception\PhpUnitViolationException;
use PhpGitHooks\Module\PhpUnit\Model\PhpUnitProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpUnitToolHandler implements CommandHandlerInterface
{
    const EXECUTING_MESSAGE = 'Running unit tests';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var PhpUnitProcessorInterface
     */
    private $phpUnitProcessor;
    /**
     * @var PhpUnitProcessorInterface
     */
    private $phpUnitRandomizerProcessor;

    /**
     * PhpUnitTool constructor.
     *
     * @param OutputInterface $output
     * @param PhpUnitProcessorInterface $phpUnitProcessor
     * @param PhpUnitProcessorInterface $phpUnitRandomizerProcessor
     */
    public function __construct(
        OutputInterface $output,
        PhpUnitProcessorInterface $phpUnitProcessor,
        PhpUnitProcessorInterface $phpUnitRandomizerProcessor
    ) {
        $this->output = $output;
        $this->phpUnitProcessor = $phpUnitProcessor;
        $this->phpUnitRandomizerProcessor = $phpUnitRandomizerProcessor;
    }

    /**
     * @param string $randomMode
     * @param string $options
     * @param string $errorMessage
     * @param bool $enableFaces
     *
     * @throws PhpUnitViolationException
     */
    private function execute($randomMode, $options, $errorMessage, $enableFaces)
    {
        $outputMessage = new PreCommitOutputWriter(self::EXECUTING_MESSAGE);
        $this->output->writeln($outputMessage->getMessage());

        $testResult = $this->executeTool($randomMode, $options);

        if (false === $testResult) {
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage, $enableFaces));

            throw new PhpUnitViolationException();
        }
    }

    /**
     * @param bool $randomMode
     * @param string $options
     *
     * @return bool
     */
    protected function executeTool($randomMode, $options)
    {
        return true === $randomMode ? $this->phpUnitRandomizerProcessor->process(
            $options
        ) : $this->phpUnitProcessor->process($options);
    }

    /**
     * @param CommandInterface|PhpUnitTool $command
     *
     * @throws PhpUnitViolationException
     */
    public function handle(CommandInterface $command)
    {
        $this->execute(
            $command->isRandomMode(),
            $command->getOptions(),
            $command->getErrorMessage(),
            $command->isEnableFaces()
        );
    }
}
