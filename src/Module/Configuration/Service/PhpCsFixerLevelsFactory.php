<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Level;
use Module\Configuration\Domain\PhpCsFixerLevels;

class PhpCsFixerLevelsFactory
{
    /**
     * @param array $data
     *
     * @return PhpCsFixerLevels
     */
    public static function fromArray(array $data)
    {
        return new PhpCsFixerLevels(
            new Level($data['psr0']),
            new Level($data['psr1']),
            new Level($data['psr2']),
            new Level($data['symfony'])
        );
    }

    /**
     * @return PhpCsFixerLevels
     */
    public static function setUndefined()
    {
        return new PhpCsFixerLevels(
            new Level(false),
            new Level(false),
            new Level(false),
            new Level(false)
        );
    }
}
