<?php

namespace PhpGitHooks\Module\PhpMd\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpMd\Contract\Exception\PhpMdViolationsException;
use PhpGitHooks\Module\PhpMd\Model\PhpMdToolProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PhpMdToolHandler implements CommandHandlerInterface
{
    const CHECKING_MESSAGE = 'Checking code mess with PHPMD';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var PhpMdToolProcessorInterface
     */
    private $phpMdToolProcessor;

    /**
     * PhpMdTool constructor.
     *
     * @param OutputInterface             $output
     * @param PhpMdToolProcessorInterface $phpMdToolProcessor
     */
    public function __construct(OutputInterface $output, PhpMdToolProcessorInterface $phpMdToolProcessor)
    {
        $this->output = $output;
        $this->phpMdToolProcessor = $phpMdToolProcessor;
    }

    /**
     * @param array $files
     * @param string $options
     * @param string $errorMessage
     * @param bool $enableFaces
     *
     * @throws PhpMdViolationsException
     */
    private function execute(array  $files, $options, $errorMessage, $enableFaces)
    {
        $outputMessage = new PreCommitOutputWriter(self::CHECKING_MESSAGE);
        $this->output->write($outputMessage->getMessage());

        $errors = [];
        foreach ($files as $file) {
            $errors[] = $this->phpMdToolProcessor->process($file, $options);
        }

        $errors = array_filter($errors);

        if (!empty($errors)) {
            $outputText = $outputMessage->setError(implode('', $errors));
            $this->output->writeln($outputMessage->getFailMessage());
            $this->output->writeln($outputText);
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage, $enableFaces));
            throw new PhpMdViolationsException();
        }

        $this->output->writeln($outputMessage->getSuccessfulMessage());
    }

    /**
     * @param CommandInterface|PhpMdTool $command
     *
     * @throws PhpMdViolationsException
     */
    public function handle(CommandInterface $command)
    {
        $this->execute(
            $command->getFiles(),
            $command->getOptions(),
            $command->getErrorMessage(),
            $command->isEnableFaces()
        );
    }
}
