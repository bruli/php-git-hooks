<?php

namespace Module\Shared\Service;

class PhpFilesChecker
{
    /**
     * @param array $files
     *
     * @return bool
     */
    public static function exists(array $files)
    {
        $exist = false;
        foreach ($files as $file) {
            if (true === (bool) preg_match('/^(.*)(\.php)$/', $file)) {
                $exist = true;
            }
        }

        return $exist;
    }
}
