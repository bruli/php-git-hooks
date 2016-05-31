<?php

namespace Module\Configuration\Model;

interface ConfigurationFileReaderInterface
{
    /**
     * @return array
     */
    public function getData();
}
