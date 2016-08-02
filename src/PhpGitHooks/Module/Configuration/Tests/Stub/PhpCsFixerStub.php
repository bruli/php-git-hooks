<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixer;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixerLevels;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixerOptions;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpCsFixerStub implements RandomStubInterface
{
    /**
     * @param Undefined         $undefined
     * @param Enabled           $enabled
     * @param PhpCsFixerLevels  $levels
     * @param PhpCsFixerOptions $options
     *
     * @return PhpCsFixer
     */
    public static function create(Undefined $undefined, Enabled $enabled, PhpCsFixerLevels $levels, PhpCsFixerOptions $options)
    {
        return new PhpCsFixer($undefined, $enabled, $levels, $options);
    }

    /**
     * @return PhpCsFixer
     */
    public static function random()
    {
        return self::create(new Undefined(false), EnabledStub::random(), PhpCsFixerLevelsStub::random(), PhpCsFixerOptionsStub::random());
    }

    /**
     * @return PhpCsFixer
     */
    public static function createEnabled()
    {
        return self::create(new Undefined(false), EnabledStub::create(true), PhpCsFixerLevelsStub::createEnabled(), PhpCsFixerOptionsStub::create(null));
    }
}
