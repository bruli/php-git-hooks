<?php

namespace PhpGitHooks\Module\Git\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;
use Symfony\Component\Console\Input\InputInterface;

class CommitMsg implements CommandInterface
{
    /**
     * @var InputInterface
     */
    private $input;

    /**
     * CommitMsgCommand constructor.
     *
     * @param InputInterface $input
     */
    public function __construct(InputInterface $input)
    {
        $this->input = $input;
    }

    /**
     * @return InputInterface
     */
    public function getInput()
    {
        return $this->input;
    }
}
