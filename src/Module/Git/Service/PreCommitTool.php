<?php

namespace Module\Git\Service;

use Infrastructure\CommandBus\CommandBus;
use Infrastructure\QueryBus\QueryBus;
use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Composer\Contract\CommandHandler\ComposerToolCommandHandler;
use Module\Configuration\Contract\Query\ConfigurationDataFinderQuery;
use Module\Configuration\Contract\QueryHandler\ConfigurationDataFinderQueryHandler;
use Module\Configuration\Contract\Response\ConfigurationDataResponse;
use Module\Git\Contract\Response\GoodJobLogoResponse;
use Module\Git\Infrastructure\Files\FilesCommittedExtractor;
use Module\JsonLint\Contract\Command\JsonLintToolCommand;
use Module\JsonLint\Contract\CommandHandler\JsonLintToolCommandHandler;
use Module\PhpCs\Contract\Command\PhpCsToolCommand;
use Module\PhpCs\Contract\CommandHandler\PhpCsToolCommandHandler;
use Module\PhpCsFixer\Contract\Command\PhpCsFixerToolCommand;
use Module\PhpCsFixer\Contract\CommandHandler\PhpCsFixerToolCommandHandler;
use Module\PhpLint\Contract\Command\PhpLintToolCommand;
use Module\PhpLint\Contract\CommandHandler\PhpLintToolCommandHandler;
use Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use Module\PhpUnit\Contract\CommandHandler\PhpUnitToolCommandHandler;
use Symfony\Component\Console\Output\OutputInterface;

class PreCommitTool
{
    const NO_FILES_CHANGED_MESSAGE = '<comment>No files changed.</comment>';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var FilesCommittedExtractor
     */
    private $filesCommittedExtractor;
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * PreCommitTool constructor.
     *
     *
     * @param OutputInterface $output
     * @param FilesCommittedExtractor $filesCommittedExtractor
     * @param QueryBus $queryBus
     * @param CommandBus $commandBus
     */
    public function __construct(
        OutputInterface $output,
        FilesCommittedExtractor $filesCommittedExtractor,
        QueryBus $queryBus,
        CommandBus $commandBus
    ) {
        $this->filesCommittedExtractor = $filesCommittedExtractor;
        $this->output = $output;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function execute()
    {
        $committedFiles = $this->filesCommittedExtractor->getFiles();

        if (1 === count($committedFiles)) {
            $this->output->writeln(static::NO_FILES_CHANGED_MESSAGE);
            return;
        }

        $configurationData = $this->queryBus->handle(new ConfigurationDataFinderQuery());

        if (true === $configurationData->isPreCommit()) {
            $this->executeTools($configurationData, $committedFiles);
        }

        $this->output->writeln(GoodJobLogoResponse::paint($configurationData->getRightMessage()));

    }

    /**
     * @param ConfigurationDataResponse $configurationData
     * @param array $committedFiles
     */
    private function executeTools(ConfigurationDataResponse $configurationData, array $committedFiles)
    {
        if (true === $configurationData->isComposer()) {
            $this->commandBus->handle(
                new ComposerToolCommand($committedFiles, $configurationData->getErrorMessage())
            );
        }

        if (true == $configurationData->isJsonLint()) {
            $this->commandBus->handle(
                new JsonLintToolCommand($committedFiles, $configurationData->getErrorMessage())
            );
        }

        if (true === $configurationData->isPhpLint()) {
            $this->commandBus->handle(
                new PhpLintToolCommand($committedFiles, $configurationData->getErrorMessage())
            );
        }

        if (true === $configurationData->isPhpCs()) {
            $this->commandBus->handle(
                new PhpCsToolCommand($committedFiles, $configurationData->getPhpCsStandard())
            );
        }

        if (true === $configurationData->isPhpCsFixer()) {
            $this->commandBus->handle(
                new PhpCsFixerToolCommand(
                    $committedFiles,
                    $configurationData->isPhpCsFixerPsr0(),
                    $configurationData->isPhpCsFixerPsr1(),
                    $configurationData->isPhpCsFixerPsr2(),
                    $configurationData->isPhpCsFixerSymfony()
                )
            );
        }

        if (true === $configurationData->isPhpunit()) {
            $this->commandBus->handle(
                new PhpUnitToolCommand(
                    $configurationData->isPhpunitRandomMode(),
                    $configurationData->getPhpunitOptions()
                )
            );
        }
    }
}
