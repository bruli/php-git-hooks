<?php

namespace PhpGitHooks\Module\Shared\Domain;

use PhpGitHooks\Module\Shared\Model\NullableInterface;

abstract class AbstractValueObject
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        if (!$this->guardNullable($value)) {
            $this->guard($value);
        }
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value();
    }

    /**
     * @param $value
     *
     * @return bool
     *
     * @throws \Exception
     */
    abstract protected function guard($value);

    /**
     * @param $value
     *
     * @return bool
     */
    private function guardNullable($value)
    {
        return is_null($value) && $this instanceof NullableInterface;
    }
}
