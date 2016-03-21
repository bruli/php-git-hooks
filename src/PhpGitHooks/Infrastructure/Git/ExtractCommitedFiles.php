<?php

namespace PhpGitHooks\Infrastructure\Git;

/**
 * Class ExtractCommitedFiles.
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

        exec("git diff --name-only $against", $this->output);
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
