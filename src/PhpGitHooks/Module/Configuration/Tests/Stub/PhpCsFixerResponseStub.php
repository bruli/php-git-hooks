<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpCsFixerResponse;

class PhpCsFixerResponseStub
{
    /**
     * @param bool $phpCsFixer
     * @param bool $psr0
     * @param bool $psr1
     * @param bool $psr2
     * @param bool $symfony
     *
     * @return PhpCsFixerResponse
     */
    public static function create($phpCsFixer, $psr0, $psr1, $psr2, $symfony)
    {
        return new PhpCsFixerResponse($phpCsFixer, $psr0, $psr1, $psr2, $symfony);
    }

    /**
     * @return PhpCsFixerResponse
     */
    public static function createEnabled()
    {
        return self::create(true, true, true, true, true);
    }
}
