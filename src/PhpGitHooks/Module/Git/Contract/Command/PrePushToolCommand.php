<?php

namespace PhpGitHooks\Module\Git\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class PrePushToolCommand implements CommandInterface
{
    /**
     * @var string
     */
    private $remote;
    /**
     * @var string
     */
    private $url;

    /**
     * PrePushToolCommand constructor.
     *
     * @param string $remote
     * @param string $url
     */
    public function __construct($remote, $url)
    {
        $this->remote = $remote;
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getRemote()
    {
        return $this->remote;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
