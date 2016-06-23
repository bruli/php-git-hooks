<?php

namespace PhpGitHooks\Module\Files\Tests\Stub;

use PhpGitHooks\Module\Files\Contract\Response\ComposerFilesResponse;

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
        return self::create(true, true, false);
    }

    /**
     * @return ComposerFilesResponse
     */
    public static function createNoData()
    {
        return self::create(false, false, false);
    }
}
