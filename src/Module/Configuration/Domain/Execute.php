<?php

namespace Module\Configuration\Domain;

use Module\Configuration\Contract\Exception\InvalidToolInterfaceException;
use Module\Configuration\Model\ExecuteInterface;
use Module\Configuration\Model\ToolInterface;

class Execute implements ExecuteInterface
{
    /**
     * @var ToolInterface[]
     */
    private $tools;

    /**
     * Execute constructor.
     *
     * @param ToolInterface[] $tools
     *
     * @throws InvalidToolInterfaceException
     */
    public function __construct(array $tools)
    {
        foreach ($tools as $tool) {
            if (!$tool instanceof ToolInterface) {
                throw new InvalidToolInterfaceException($tool);
            }
        }
        $this->tools = $tools;
    }

    /**
     * @return ToolInterface[]
     */
    public function execute()
    {
        return $this->tools;
    }

    /**
     * @return Execute
     */
    public function disableTools()
    {
        $tools = [];

        foreach ($this->tools as $key => $tool) {
            $tools[$key] = $tool->setEnabled(new Enabled(false));
        }

        return new self($tools);
    }
}
