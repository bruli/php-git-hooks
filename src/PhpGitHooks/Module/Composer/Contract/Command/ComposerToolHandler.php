<?php

namespace PhpGitHooks\Module\Composer\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use Bruli\EventBusBundle\QueryBus\QueryBus;
use PhpGitHooks\Module\Composer\Contract\Exception\ComposerFilesNotFoundException;
use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractor;
use PhpGitHooks\Module\Files\Contract\Response\ComposerFilesResponse;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use Symfony\Component\Console\Output\OutputInterface;

class ComposerToolHandler implements CommandHandlerInterface
{
    const CHECKING_MESSAGE = 'Checking composer files';
    /**
     * @var PreCommitOutputWriter
     */
    private $outputMessage;
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var QueryBus
     */
    private $queryBus;
    /**
     * ComposerTool constructor.
     *
     * @param QueryBus        $queryBus
     * @param OutputInterface $output
     */
    public function __construct(
        QueryBus $queryBus,
        OutputInterface $output
    ) {
        $this->output = $output;
        $this->queryBus = $queryBus;
    }

    /**
     * @param CommandInterface|ComposerTool $command
     *
     * @throws ComposerFilesNotFoundException
     */
    public function handle(CommandInterface $command)
    {
        $this->execute($command->getFiles(), $command->getErrorMessage(), $command->isEnableFaces());
    }

    /**
     * @param array $files
     * @param string $errorMessage
     * @param bool $enableFaces
     *
     * @throws ComposerFilesNotFoundException
     */
    private function execute(array $files, $errorMessage, $enableFaces)
    {
        $composerFilesResponse = $this->getComposerFilesResponse($files);

        $this->outputMessage = new PreCommitOutputWriter(self::CHECKING_MESSAGE);
        if (true === $composerFilesResponse->isExists()) {
            $this->output->write($this->outputMessage->getMessage());

            $this->executeTool(
                $composerFilesResponse->isJsonFile(),
                $composerFilesResponse->isLockFile(),
                $errorMessage,
                $enableFaces
            );
            $this->output->writeln($this->outputMessage->getSuccessfulMessage());
        }
    }

    /**
     * @param bool $jsonFile
     * @param bool $lockFile
     * @param string $errorMessage
     * @param bool $enableFaces
     *
     * @throws ComposerFilesNotFoundException *
     */
    private function executeTool($jsonFile, $lockFile, $errorMessage, $enableFaces)
    {
        if (true === $jsonFile && false === $lockFile) {
            $this->output->writeln($this->outputMessage->getFailMessage());
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage, $enableFaces));
            throw new ComposerFilesNotFoundException();
        }
    }

    /**
     * @param array $files
     *
     * @return ComposerFilesResponse
     */
    private function getComposerFilesResponse(array $files)
    {
        return $this->queryBus->handle(new ComposerFilesExtractor($files));
    }
}
