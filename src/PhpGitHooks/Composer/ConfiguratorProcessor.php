<?php

namespace PhpGitHooks\Composer;

use Composer\IO\IOInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use Symfony\Component\Yaml\Yaml;

class ConfiguratorProcessor
{
    const CONFIG_FILE = 'php-git-hooks.yml';
    /** @var  IOInterface */
    private $io;

    private $preCommitData = array();
    private $preCommitTools = ['phpunit', 'phplint', 'php-cs-fixer', 'phpcs', 'phpmd'];

    public function __construct(IOInterface $io)
    {
        $this->io = $io;
    }

    public function process()
    {
        $this->initConfigFile();
    }

    private function initConfigFile()
    {
        if (false === file_exists(self::CONFIG_FILE)) {
            $generate = $this->setQuestion('Do you want generate a php-git.hooks.yml file?', 'Y/n', 'Y');

            if ('N' === strtoupper($generate)) {
                $this->io->write(
                    '<error>Remember that you need a configuration file to use php-git-hooks library.</error>'
                );

                return;
            }

            $this->enablePreCommit();

            foreach ($this->preCommitTools as $tool) {
                $this->enableExecutePreCommitTool($tool);
            }

            $this->writeConfigFile();
        }
    }

    /**
     * @param  string $question
     * @param  string $answers
     * @param  string $default
     * @return string
     */
    private function setQuestion($question, $answers, $default)
    {
        return $this->io
            ->ask(sprintf('<question>%s</question> (<comment>%s</comment>): ', $question, $answers), $default);
    }

    private function enablePreCommit()
    {
        $enablePrecommit = $this->setQuestion(
            'Do you want enable pre-commit hook?',
            'Y/n',
            'Y'
        );

        $enabled = false;

        if ('Y' === strtoupper($enablePrecommit)) {
            $this->copyHookFile('pre-commit');
            $enabled = true;
        }
        $this->preCommitData['pre-commit'] = ['enabled' => $enabled];
    }

    /**
     * @param $hook
     */
    private function copyHookFile($hook)
    {
        if (false === file_exists('.git/hooks/' . $hook)) {
            $copy = new Process('cp ' . __DIR__ . '/../../../hooks/' . $hook . ' .git/hooks/' . $hook);
            $copy->run();
        }
    }

    /**
     * @param $tool
     */
    private function enableExecutePreCommitTool($tool)
    {
        $execute = true;

        $executeTool = $this->setQuestion(
            sprintf('Do you want execute %s in pre-commit hook?', strtoupper($tool)),
            'Y/n',
            'Y'
        );

        if ('N' === strtoupper($executeTool)) {
            $execute = false;
        }

        $this->preCommitData['pre-commit']['execute'][$tool] = $execute;
    }

    private function writeConfigFile()
    {
        $data = Yaml::dump($this->preCommitData);

        file_put_contents(self::CONFIG_FILE, $data);
    }
}
