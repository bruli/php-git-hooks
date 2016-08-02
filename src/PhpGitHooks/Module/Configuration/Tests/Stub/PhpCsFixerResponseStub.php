<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpCsFixerResponse;

class PhpCsFixerResponseStub
{
    const OPTIONS = '--diff';

    /**
     * @param bool $phpCsFixer
     * @param bool $psr0
     * @param bool $psr1
     * @param bool $psr2
     * @param bool $symfony
     * @param string|null $options
     *
     * @return PhpCsFixerResponse
     */
    public static function create($phpCsFixer, $psr0, $psr1, $psr2, $symfony, $options)
    {
        return new PhpCsFixerResponse($phpCsFixer, $psr0, $psr1, $psr2, $symfony, $options);
    }

    /**
     * @return PhpCsFixerResponse
     */
    public static function createEnabled()
    {
        return self::create(true, true, true, true, true, self::OPTIONS);
    }
}
