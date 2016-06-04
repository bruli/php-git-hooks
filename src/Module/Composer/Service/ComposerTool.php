<?php

namespace Module\Composer\Service;

use Module\Composer\Contract\Exception\ComposerFilesNotFoundException;
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
     * ComposerTool constructor.
     *
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param array $files
     *
     * @param string $errorMessage
     * @throws ComposerFilesNotFoundException
     */
    public function execute(array $files, $errorMessage)
    {
        if (true === $this->checkComposerFiles($files)) {
            $this->output->write(static::CHECKING_MESAGE);
            $this->executeTool($files, $errorMessage);
            $this->output->writeln(static::OK);
        }
    }

    /**
     * @param array $files
     *
     * @return bool
     */
    private function checkComposerFiles(array $files)
    {
        $exists = false;
        foreach ($files as $file) {
            if (true === (bool) preg_match('/^composer\.(json|lock)$/', $file)) {
                $exists = true;
            }
        }

        return $exists;
    }

    /**
     * @param array $files
     *
     * @param string $errorMessage
     * @throws ComposerFilesNotFoundException
     */
    private function executeTool(array $files, $errorMessage)
    {
        $composerJsonDetected = false;
        $composerLockDetected = false;

        foreach ($files as $file) {
            if ($file == 'composer.json') {
                $composerJsonDetected = true;
            }

            if ($file == 'composer.lock') {
                $composerLockDetected = true;
            }
        }

        if (true === $composerJsonDetected && true === $composerLockDetected) {
            return;
        }
        $this->output->writeln(BadJobLogoResponse::paint($errorMessage));
        throw new ComposerFilesNotFoundException();
    }
}
