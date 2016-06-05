<?php

namespace Module\Git\Service;

use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Composer\Contract\CommandHandler\ComposerToolCommandHandler;
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
    const OK_MESSAGE = '<comment>0K</comment>';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var FilesCommittedExtractor
     */
    private $filesCommittedExtractor;
    /**
     * @var ConfigurationDataFinderQueryHandler
     */
    private $configurationDataFinderQueryHandler;
    /**
     * @var ComposerToolCommandHandler
     */
    private $composerToolCommandHandler;
    /**
     * @var JsonLintToolCommandHandler
     */
    private $jsonLintToolCommandHandler;
    /**
     * @var PhpLintToolCommandHandler
     */
    private $phpLintToolCommandHandler;
    /**
     * @var PhpCsToolCommandHandler
     */
    private $phpCsToolCommandHandler;
    /**
     * @var PhpCsFixerToolCommandHandler
     */
    private $phpCsFixerToolCommandHandler;
    /**
     * @var PhpUnitToolCommandHandler
     */
    private $phpUnitToolCommandHandler;

    /**
     * PreCommitTool constructor.
     *
     *
     * @param OutputInterface                     $output
     * @param FilesCommittedExtractor             $filesCommittedExtractor
     * @param ConfigurationDataFinderQueryHandler $configurationDataFinderQueryHandler
     * @param ComposerToolCommandHandler          $composerToolCommandHandler
     * @param JsonLintToolCommandHandler          $jsonLintToolCommandHandler
     * @param PhpLintToolCommandHandler           $phpLintToolCommandHandler
     * @param PhpCsToolCommandHandler             $phpCsToolCommandHandler
     * @param PhpCsFixerToolCommandHandler        $phpCsFixerToolCommandHandler
     * @param PhpUnitToolCommandHandler           $phpUnitToolCommandHandler
     */
    public function __construct(
        OutputInterface $output,
        FilesCommittedExtractor $filesCommittedExtractor,
        ConfigurationDataFinderQueryHandler $configurationDataFinderQueryHandler,
        ComposerToolCommandHandler $composerToolCommandHandler,
        JsonLintToolCommandHandler $jsonLintToolCommandHandler,
        PhpLintToolCommandHandler $phpLintToolCommandHandler,
        PhpCsToolCommandHandler $phpCsToolCommandHandler,
        PhpCsFixerToolCommandHandler $phpCsFixerToolCommandHandler,
        PhpUnitToolCommandHandler $phpUnitToolCommandHandler
    ) {
        $this->filesCommittedExtractor = $filesCommittedExtractor;
        $this->configurationDataFinderQueryHandler = $configurationDataFinderQueryHandler;
        $this->composerToolCommandHandler = $composerToolCommandHandler;
        $this->jsonLintToolCommandHandler = $jsonLintToolCommandHandler;
        $this->phpLintToolCommandHandler = $phpLintToolCommandHandler;
        $this->phpCsToolCommandHandler = $phpCsToolCommandHandler;
        $this->phpCsFixerToolCommandHandler = $phpCsFixerToolCommandHandler;
        $this->phpUnitToolCommandHandler = $phpUnitToolCommandHandler;
        $this->output = $output;
    }

    public function execute()
    {
        $outputMessage = static::NO_FILES_CHANGED_MESSAGE;

        $committedFiles = $this->filesCommittedExtractor->getFiles();

        if (1 < count($committedFiles)) {
            $configurationData = $this->configurationDataFinderQueryHandler->handle();

            if (true === $configurationData->isPreCommit()) {
                $this->executeTools($configurationData, $committedFiles);
            }

            $this->output->writeln(GoodJobLogoResponse::paint($configurationData->getRightMessage()));
            $outputMessage = self::OK_MESSAGE;
        }

        $this->output->writeln($outputMessage);
    }

    /**
     * @param ConfigurationDataResponse $configurationData
     * @param array                     $committedFiles
     */
    private function executeTools(ConfigurationDataResponse $configurationData, array $committedFiles)
    {
        if (true === $configurationData->isComposer()) {
            $this->composerToolCommandHandler->handle(
                new ComposerToolCommand($committedFiles, $configurationData->getErrorMessage())
            );
        }

        if (true == $configurationData->isJsonLint()) {
            $this->jsonLintToolCommandHandler->handle(
                new JsonLintToolCommand($committedFiles, $configurationData->getErrorMessage())
            );
        }

        if (true === $configurationData->isPhpLint()) {
            $this->phpLintToolCommandHandler->handle(
                new PhpLintToolCommand($committedFiles)
            );
        }

        if (true === $configurationData->isPhpCs()) {
            $this->phpCsToolCommandHandler->handle(
                new PhpCsToolCommand($committedFiles, $configurationData->getPhpCsStandard())
            );
        }

        if (true === $configurationData->isPhpCsFixer()) {
            $this->phpCsFixerToolCommandHandler->handle(
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
            $this->phpUnitToolCommandHandler->handle(
                new PhpUnitToolCommand(
                    $configurationData->isPhpunitRandomMode(),
                    $configurationData->getPhpunitOptions()
                )
            );
        }
    }
}
