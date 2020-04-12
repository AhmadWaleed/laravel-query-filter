<?php

namespace AhmedWaleed\QueryFilter\Tests\Models;

use AhmedWaleed\QueryFilter\QueryScopes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use QueryScopes;
}
