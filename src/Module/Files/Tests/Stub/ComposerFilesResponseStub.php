<?php

namespace Module\Files\Tests\Stub;

use Module\Files\Contract\Response\ComposerFilesResponse;

class ComposerFilesResponseStub
{
    /**
     * @param bool $exist
     * @param bool $jsonFile
     * @param bool $lockFile
     *
     * @return ComposerFilesResponse
     */
    public static function create($exist, $jsonFile, $lockFile)
    {
        return new ComposerFilesResponse($exist, $jsonFile, $lockFile);
    }

    /**
     * @return ComposerFilesResponse
     */
    public static function createValidData()
    {
        return self::create(true, true, true);
    }

    /**
     * @return ComposerFilesResponse
     */
    public static function createInvalidData()
    {
        return self::create(true, false, true);
    }

    /**
     * @return ComposerFilesResponse
     */
    public static function createNoData()
    {
        return self::create(false, false, false);
    }
}
