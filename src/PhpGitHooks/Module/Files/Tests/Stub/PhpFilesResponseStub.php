<?php

namespace PhpGitHooks\Module\Files\Tests\Stub;

use PhpGitHooks\Module\Files\Contract\Response\PhpFilesResponse;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

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
