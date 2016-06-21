<?php

namespace PhpGitHooks\Module\Files\Tests\Stub;

use PhpGitHooks\Module\Files\Contract\Response\PhpFilesResponse;

class PhpFilesResponseStub
{
    /**
     * @param array $files
     *
     * @return PhpFilesResponse
     */
    public static function create(array $files)
    {
        return new PhpFilesResponse($files);
    }
}
