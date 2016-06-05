<?php

namespace Module\Composer\Service;

use Module\Composer\Contract\Exception\ComposerFilesNotFoundException;
use Module\Files\Contract\Query\ComposerFilesExtractorQuery;
use Module\Files\Contract\QueryHandler\ComposerFilesExtractorQueryHandler;
use Module\Git\Contract\Response\BadJobLogoResponse;
use Symfony\Component\Console\Output\OutputInterface;

class ComposerTool
{
    const CHECKING_MESAGE = '<info>Checking composer files.... </info>';
    const OK = '<comment>0K</comment>';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var ComposerFilesExtractorQueryHandler
     */
    private $composerFilesExtractorQueryHandler;

    /**
     * ComposerTool constructor.
     *
     * @param ComposerFilesExtractorQueryHandler $composerFilesExtractorQueryHandler
     * @param OutputInterface                    $output
     */
    public function __construct(
        ComposerFilesExtractorQueryHandler $composerFilesExtractorQueryHandler,
        OutputInterface $output
    ) {
        $this->output = $output;
        $this->composerFilesExtractorQueryHandler = $composerFilesExtractorQueryHandler;
    }

    /**
     * @param array  $files
     * @param string $errorMessage
     *
     * @throws ComposerFilesNotFoundException
     */
    public function execute(array $files, $errorMessage)
    {
        $composerFilesResponse = $this->getComposerFilesResponse($files);

        if (true === $composerFilesResponse->isExists()) {
            $this->output->write(static::CHECKING_MESAGE);
            $this->executeTool(
                $composerFilesResponse->isJsonFile(),
                $composerFilesResponse->isLockFile(),
                $errorMessage
            );
            $this->output->writeln(static::OK);
        }
    }

    /**
     * @param bool   $jsonFile
     * @param bool   $lockFile
     * @param string $errorMessage
     *
     * @throws ComposerFilesNotFoundException *
     */
    private function executeTool($jsonFile, $lockFile, $errorMessage)
    {
        if (true === $jsonFile && true === $lockFile) {
            return;
        }
        $this->output->writeln(BadJobLogoResponse::paint($errorMessage));
        throw new ComposerFilesNotFoundException();
    }

    /**
     * @param array $files
     *
     * @return \Module\Files\Contract\Response\ComposerFilesResponse
     */
    private function getComposerFilesResponse(array $files)
    {
        return $this->composerFilesExtractorQueryHandler
            ->handle(new ComposerFilesExtractorQuery($files));
    }
}
