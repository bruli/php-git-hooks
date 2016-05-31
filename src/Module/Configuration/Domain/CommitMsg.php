<?php

namespace Module\Configuration\Domain;

use Module\Configuration\Model\ToolInterface;

class CommitMsg implements ToolInterface
{
    /**
     * @var Enabled
     */
    private $enabled;
    /**
     * @var RegularExpression
     */
    private $regularExpression;
    /**
     * @var Undefined
     */
    private $undefined;

    /**
     * CommitMsg constructor.
     *
     * @param Undefined         $undefined
     * @param Enabled           $enabled
     * @param RegularExpression $regularExpression
     */
    public function __construct(Undefined $undefined, Enabled $enabled, RegularExpression $regularExpression)
    {
        $this->enabled = $enabled;
        $this->regularExpression = $regularExpression;
        $this->undefined = $undefined;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled->value();
    }

    /**
     * @return RegularExpression
     */
    public function getRegularExpression()
    {
        return $this->regularExpression;
    }

    /**
     * @return bool
     */
    public function isUndefined()
    {
        return $this->undefined->value();
    }

    /**
     * @param Enabled $enabled
     *
     * @return CommitMsg
     */
    public function setEnabled(Enabled $enabled)
    {
        return new self(
            new Undefined(false),
            $enabled,
            $this->regularExpression
        );
    }

    /**
     * @param RegularExpression $regularExpression
     *
     * @return CommitMsg
     */
    public function addRegularExpression(RegularExpression $regularExpression)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $regularExpression
        );
    }
}
