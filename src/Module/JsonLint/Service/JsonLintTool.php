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
     * JsonLintTool constructor.
     *
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param array $files
     */
    public function execute(array $files)
    {
        if (true === $this->jsonFilesExists($files)) {
            $this->output->write(self::CHECKING_MESSAGE);
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
