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
                '/path1/path2/file1.php',
                '/path1/path2/file2.php',
                '/path1/path2/file3.php',
                'file2.php',
                'file3.php'
            ]
        );
    }/**
     * @return array
     */
    public static function createWithoutComposerFiles()
    {
        $generator = StubCreator::faker();

        return self::create(
            [
                $generator->sha1,
                '/path1/path2/file1.php',
                '/path1/path2/file2.php',
                '/path1/path2/file3.php',
                'file2.php',
                'file3.php'
            ]
        );
    }

    /**
     * @return array
     */
    public static function createInvalidComposerFiles()
    {
        $files = [
            [
                StubCreator::faker()->sha1,
                'composer.json'
            ],
            [
                StubCreator::faker()->sha1,
                'composer.lock'
            ]
        ];

        return self::create($files[array_rand($files)]);
    }
}
