<?php

namespace Module\Files\Tests\Stub;

use Module\Files\Contract\Response\PhpFilesResponse;
use Module\Git\Tests\Stub\FilesCommittedStub;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

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
