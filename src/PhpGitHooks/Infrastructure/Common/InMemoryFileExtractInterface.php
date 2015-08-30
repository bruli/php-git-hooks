<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Class InMemoryFileExtractInterface.
 */
class InMemoryFileExtractInterface implements FileExtractInterface
{
    /** @var  string */
    private $extract;

    /**
     * @param string $file
     *
     * @return string
     */
    public function extract($file)
    {
        return $this->extract;
    }

    /**
     * @param string $extract
     */
    public function setExtract($extract)
    {
        $this->extract = $extract;
    }
}
