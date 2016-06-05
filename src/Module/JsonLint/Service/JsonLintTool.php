<?php

namespace Module\JsonLint\Service;

use Symfony\Component\Console\Output\OutputInterface;

class JsonLintTool
{
    const CHECKING_MESSAGE = '<info>Checking json files....... </info>';
    const OK = '<comment>0K</comment>';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var JsonLintToolExecutor
     */
    private $jsonLintToolExecutor;

    /**
     * JsonLintTool constructor.
     *
     * @param OutputInterface $output
     * @param JsonLintToolExecutor $jsonLintToolExecutor
     */
    public function __construct(OutputInterface $output, JsonLintToolExecutor $jsonLintToolExecutor)
    {
        $this->output = $output;
        $this->jsonLintToolExecutor = $jsonLintToolExecutor;
    }

    /**
     * @param array $files
     * @param string $errorMessage
     */
    public function execute(array $files, $errorMessage)
    {
        if (true === $this->jsonFilesExists($files)) {
            $this->output->write(self::CHECKING_MESSAGE);
            $this->jsonLintToolExecutor->execute($files, $errorMessage);
            $this->output->writeln(self::OK);
        }
    }

    /**
     * @param array $files
     *
     * @return bool
     */
    private function jsonFilesExists(array $files)
    {
        $exist = false;
        foreach ($files as $file) {
            if (true === (bool) preg_match('/^(.*)(\.json)$/', $file)) {
                $exist = true;
            }
        }

        return $exist;
    }
}
