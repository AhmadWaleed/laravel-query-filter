<?php

namespace AhmedWaleed\QueryFilter;

trait QueryScopes
{
    /**
     * Add query scope to model
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \AhmedWaleed\QueryFilter\Queryable $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAddQuery($builder, $query)
    {
        if ($query->canApply()) {
            $query->apply($builder);
        }
    }
}
