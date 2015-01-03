<?php

namespace PhpGitHooks\Infraestructure\Git;

/**
 * Class ExtractCommitedFiles
 * @package PhpGitHooks\Infraestructure\Git
 */
class ExtractCommitedFiles
{
    /** @var array */
    private $output = array();
    /** @var int */
    private $rc = 0;

    private function execute()
    {
        exec('git rev-parse --verify HEAD 2> /dev/null', $this->output, $this->rc);

        $against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';
        if ($this->rc === 0) {
            $against = 'HEAD';
        }

        exec("git diff-index --cached --name-status $against | egrep '^(A|M)' | awk '{print $2;}'", $this->output);
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        $this->execute();

        return $this->output;
    }
}
