<?php

namespace AhmedWaleed\QueryFilter;

interface Queryable
{
    /**
     * Set condition to determine when query should run
     *
     * @param bool $condition
     *
     * @return self
     */
    public function when($condition);

    /**
     * Determines if query can be applied
     *
     * @return bool
     */
    public function canApply();

    /**
     * Add query to applicable model
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($builder);
}