<?php

namespace Module\Configuration\Model;

interface ConfigurationFileWriterInterface
{
    /**
     * @param array $data
     */
    public function write(array $data);
}
