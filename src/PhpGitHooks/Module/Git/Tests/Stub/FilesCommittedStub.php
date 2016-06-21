<?php

namespace PhpGitHooks\Module\Git\Tests\Stub;

use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

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
                'file2.inc',
                'file3.inc',
            ]
        );
    }

    /**
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
                'file1.json',
                'file2.json',
            ]
        );
    }

    public static function createWithoutJsonFiles()
    {
        $generator = StubCreator::faker();

        return self::create(
            [
                $generator->sha1,
                '/path1/path2/file1.php',
                '/path1/path2/file2.php',
                '/path1/path2/file3.php',
            ]
        );
    }

    /**
     * @return array
     */
    public static function createInvalidComposerFiles()
    {
        $files = [
            StubCreator::faker()->sha1,
            'composer.lock',
        ];

        return self::create($files);
    }

    /**
     * @return array
     */
    public static function createWithoutPhpFiles()
    {
        $files = [
            StubCreator::faker()->sha1,
            'composer.json',
            'composer.lock',
            'file1.json',
        ];

        return self::create($files);
    }

    /**
     * @return array
     */
    public static function createOnlyPhpFiles()
    {
        $files = [
            StubCreator::faker()->sha1,
            '/path1/path2/file1.php',
            '/path1/path2/file2.php',
            '/path1/path2/file3.php',
            'file2.inc',
            'file3.inc',
        ];

        return self::create($files);
    }
}
