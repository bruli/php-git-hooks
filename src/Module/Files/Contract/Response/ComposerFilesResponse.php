<?php

namespace Module\Files\Contract\Response;

class ComposerFilesResponse
{
    /**
     * @var bool
     */
    private $exists;
    /**
     * @var bool
     */
    private $jsonFile;
    /**
     * @var bool
     */
    private $lockFile;

    /**
     * ComposerFilesResponse constructor.
     *
     * @param bool $exists
     * @param bool $jsonFile
     * @param bool $lockFile
     */
    public function __construct($exists, $jsonFile, $lockFile)
    {
        $this->exists = $exists;
        $this->jsonFile = $jsonFile;
        $this->lockFile = $lockFile;
    }

    /**
     * @return bool
     */
    public function isExists()
    {
        return $this->exists;
    }

    /**
     * @return bool
     */
    public function isJsonFile()
    {
        return $this->jsonFile;
    }

    /**
     * @return bool
     */
    public function isLockFile()
    {
        return $this->lockFile;
    }
}
