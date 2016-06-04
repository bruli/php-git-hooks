<?php

namespace Module\Git\Tests\Stub;

use Module\Tests\Infrastructure\Stub\StubCreator;

class FilesCommittedStub
{
    /**
     * @param array $files
     *
     * @return array
     */
    public static function create(array $files)
    {
        return $files;
    }

    /**
     * @return array
     */
    public static function createAllFiles()
    {
        $generator = StubCreator::faker();

        return self::create(
            [
                $generator->sha1,
                'composer.json',
                'composer.lock',
            ]
        );
    }
}
