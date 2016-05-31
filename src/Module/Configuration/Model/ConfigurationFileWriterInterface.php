<?php

namespace Module\Configuration\Model;

interface ConfigurationFileWriterInterface
{
    /**
     * @param array $data
     */
    public static function write(array $data);
}
