<?php

namespace Module\Files\Tests\Stub;

use Module\Files\Contract\Response\JsonFilesResponse;
use Module\Git\Tests\Stub\FilesCommittedStub;

class JsonFilesResponseStub
{
    /**
     * @param array $files
     *
     * @return JsonFilesResponse
     */
    public static function create(array $files)
    {
        return new JsonFilesResponse($files);
    }

    /**
     * @return JsonFilesResponse
     */
    public static function createNoData()
    {
        return self::create([]);
    }

    /**
     * @return JsonFilesResponse
     */
    public static function createWithJsonData()
    {
        return self::create(
            [
                'file1.json',
                'file2.json',
                'file3.json',
                'file4.json',
            ]
        );
    }
}
