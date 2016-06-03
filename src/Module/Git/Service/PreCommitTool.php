<?php

namespace Module\Git\Service;

use Module\Configuration\Domain\Composer;
use Module\Configuration\Domain\JsonLint;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsFixer;
use Module\Configuration\Domain\PhpLint;
use Module\Configuration\Domain\PhpMd;
use Module\Configuration\Domain\PhpUnit;
use Module\Configuration\Model\ExecuteInterface;
use Module\Configuration\Service\ConfigurationDataFinder;
use Module\Git\Infrastructure\Files\FilesCommittedExtractor;
use Symfony\Component\Console\Output\OutputInterface;

class PreCommitTool
{
    /**
     * @var ConfigurationDataFinder
     */
    private $configurationDataFinder;
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var FilesCommittedExtractor
     */
    private $filesCommittedExtractor;

    /**
     * PreCommitTool constructor.
     *
     * @param ConfigurationDataFinder $configurationDataFinder
     * @param FilesCommittedExtractor $filesCommittedExtractor
     */
    public function __construct(
        ConfigurationDataFinder $configurationDataFinder,
        FilesCommittedExtractor $filesCommittedExtractor
    ) {
        $this->configurationDataFinder = $configurationDataFinder;
        $this->filesCommittedExtractor = $filesCommittedExtractor;
    }

    /**
     * @param OutputInterface $output
     */
    public function execute(OutputInterface $output)
    {
        $this->output = $output;

        if (0 > count($this->filesCommittedExtractor->getFiles())) {
            $configurationData = $this->configurationDataFinder->find();
            $preCommit = $configurationData->getPreCommit();

            if (true === $preCommit->isEnabled()) {
                $this->executeTools($preCommit->getExecute());
            }
        }
    }

    /**
     * @param ExecuteInterface $execute
     */
    private function executeTools(ExecuteInterface $execute)
    {
        foreach ($execute->execute() as $tool) {
            if (true === $tool->isEnabled()) {
                switch (get_class($tool)) {
                    case Composer::class:
                        $this->output->writeln('composer');
                        break;
                    case JsonLint::class:
                        $this->output->writeln('jsonlint');
                        break;
                    case PhpLint::class:
                        $this->output->writeln('phplint');
                        break;
                    case PhpMd::class:
                        $this->output->writeln('phpmd');
                        break;
                    case PhpCs::class:
                        $this->output->writeln('phpcs');
                        break;
                    case PhpCsFixer::class:
                        $this->output->writeln('phpCsFixer');
                        break;
                    case PhpUnit::class:
                        $this->output->writeln('phpunit');
                        break;
                }
            }
        }
    }
}
