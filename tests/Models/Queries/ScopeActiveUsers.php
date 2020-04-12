<?php

namespace AhmedWaleed\QueryFilter\Tests\Models\Queries;

use AhmedWaleed\QueryFilter\QueryScope;

class ScopeActiveUsers extends QueryScope
{
    public function apply($builder)
    {
        $builder->whereActive(1);

        return $builder;
    }
}