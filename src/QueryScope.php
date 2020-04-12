<?php

namespace AhmedWaleed\QueryFilter;

abstract class QueryScope implements Queryable
{
    /** @var mixed $data */
    protected $data = null;

    /** @var bool $canApply */
    protected $canApply;

    public function __construct($data = null)
    {
        $this->data = $data;

        $this->canApply = true;
    }

    /** @inheritDoc */
    public function when($condition)
    {
        $this->canApply = (bool) $condition;

        return $this;
    }

    /** @inheritDoc */
    public function canApply()
    {
        return $this->canApply;
    }
}