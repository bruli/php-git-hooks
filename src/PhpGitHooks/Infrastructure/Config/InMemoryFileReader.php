<?php

namespace PhpGitHooks\Infrastructure\Config;

/**
 * Class InMemoryFileReader.
 */
class InMemoryFileReader implements FileReaderInterface
{
    /** @var  array */
    private $data;
    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
