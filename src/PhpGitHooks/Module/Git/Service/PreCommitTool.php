<?php

namespace PhpGitHooks\Module\Git\Service;

use CommandBus\CommandBus\CommandBus;
use CommandBus\QueryBus\QueryBus;
use PhpGitHooks\Module\Composer\Contract\Command\ComposerToolCommand;
use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinderQuery;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Git\Contract\Response\GoodJobLogoResponse;
use PhpGitHooks\Module\Git\Infrastructure\Files\FilesCommittedExtractor;
use PhpGitHooks\Module\Git\Infrastructure\OutputWriter\ToolTittleOutputWriter;
use PhpGitHooks\Module\JsonLint\Contract\Command\JsonLintToolCommand;
use PhpGitHooks\Module\PhpCs\Contract\Command\PhpCsToolCommand;
use PhpGitHooks\Module\PhpCsFixer\Contract\Command\PhpCsFixerToolCommand;
use PhpGitHooks\Module\PhpLint\Contract\Command\PhpLintToolCommand;
use PhpGitHooks\Module\PhpMd\Contract\Command\PhpMdToolCommand;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverageCommand;
use Symfony\Component\Console\Output\OutputInterface;

class PreCommitTool
{
    const NO_FILES_CHANGED_MESSAGE = '<comment>No files changed.</comment>';
    const TITLE = 'Pre-Commit tool';
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
     * @var ToolTittleOutputWriter
     */
    private $tittleOutputWriter;

    /**
     * PreCommitTool constructor.
     *
     *
     * @param OutputInterface $output
     * @param FilesCommittedExtractor $filesCommittedExtractor
     * @param QueryBus $queryBus
     * @param CommandBus $commandBus
     * @param ToolTittleOutputWriter $tittleOutputWriter
     */
    public function __construct(
        OutputInterface $output,
        FilesCommittedExtractor $filesCommittedExtractor,
        QueryBus $queryBus,
        CommandBus $commandBus,
        ToolTittleOutputWriter $tittleOutputWriter
    ) {
        $this->filesCommittedExtractor = $filesCommittedExtractor;
        $this->output = $output;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
        $this->tittleOutputWriter = $tittleOutputWriter;
    }

    public function execute()
    {
        $this->tittleOutputWriter->writeTitle(self::TITLE);
        $committedFiles = $this->filesCommittedExtractor->getFiles();

        if (1 === count($committedFiles)) {
            $this->output->writeln(static::NO_FILES_CHANGED_MESSAGE);

            return;
        }

        /** @var ConfigurationDataResponse $configurationData */
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

        if (true === $configurationData->isJsonLint()) {
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
                new PhpCsToolCommand(
                    $committedFiles,
                    $configurationData->getPhpCsStandard(),
                    $configurationData->getErrorMessage()
                )
            );
        }

        if (true === $configurationData->isPhpCsFixer()) {
            $this->commandBus->handle(
                new PhpCsFixerToolCommand(
                    $committedFiles,
                    $configurationData->isPhpCsFixerPsr0(),
                    $configurationData->isPhpCsFixerPsr1(),
                    $configurationData->isPhpCsFixerPsr2(),
                    $configurationData->isPhpCsFixerSymfony(),
                    $configurationData->getErrorMessage()
                )
            );
        }

        if (true === $configurationData->isPhpMd()) {
            $this->commandBus->handle(
                new PhpMdToolCommand(
                    $committedFiles,
                    $configurationData->getPhpMdOptions(),
                    $configurationData->getErrorMessage()
                )
            );
        }

        if (true === $configurationData->isPhpunit()) {
            $this->commandBus->handle(
                new PhpUnitToolCommand(
                    $configurationData->isPhpunitRandomMode(),
                    $configurationData->getPhpunitOptions(),
                    $configurationData->getErrorMessage()
                )
            );

            if (true === $configurationData->isPhpunitStrictCoverage()) {
                $this->commandBus->handle(
                    new StrictCoverageCommand(
                        $configurationData->getMinimum(),
                        $configurationData->getErrorMessage()
                    )
                );
            }
        }
    }
}
