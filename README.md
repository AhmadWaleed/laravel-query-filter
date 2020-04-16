# Add Eloquent queries from request.

This package allows you add addional queries to your eloquent model from request params (filters).

## Installation

You can install the package via composer:

```bash
composer require ahmedwaleed/laravel-query-filter
```

## Basic usage

### Create dedicated query scope class by running following command.
```bash
php artisan make:query App/Queries/ScopeActiveUsersQuery
```

```php
<?php

namespace App\Queries;

use AhmedWaleed\QueryFilter\QueryScope;

class ScopeActiveUsersQuery extends QueryScope
{
    /**
     * Add query to applicable model
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        //

        return $builder;
    }
}
```

Now you need to use `QueryScopes` trait inside your model on which you want to add addional queries.
```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model
use AhmedWaleed\QueryFilter\QueryScopes;

class User extends Model
{
  use QueryScopes;
  
  //
}
```

Inside your controller method you can add query like so
```php
//..
public function index()
{
  $users = User::addQuery(
    (new ScopeActiveUsersQuery())->when(request()->has('active'))
  )->get();
  
  return view('users.index', compact('users'));
}
//..
```

### add multipple queries:
```php

$users = User::addQuery(
    (new ScopeActiveUsersQuery())->when(request()->has('active'))
)->addQuery(
    (new ScopeUsersLocationQuery())->when(request()->has('location'))
)->get();

```

### ::when($condition) method is optional you can skipe if you always want to execute query:
```php
$users = User::addQuery(new ScopeActiveUsersQuery()))->get();
```

### you can pass addional data required for query through constructor:
```php
// controller
$data = ['limit' => 2, 'status' => request('active')];

$users = User::addQuery(new ScopeActiveUsersQuery($data)))->get();

// App\Queries\ScopeActiveUsersQuery.php

<?php

namespace App\Queries;

use AhmedWaleed\QueryFilter\QueryScope;

class ScopeActiveUsersQuery extends QueryScope
{
    /**
     * Add query to applicable model
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        $builder->whereStatus($this->data['status'] ?? 1)
          ->limit($this->data['limit'] ?? 50);

        return $builder;
    }
}
```

## A cooler usage
For small query scope like above it maybe overkill but think what if you have a huge queries and request filters either it will grow your model or controller, this package is also apply single responsiblty principle so for every scope you have dedicated class and if future it will also be easy to maintane single query instead of parsing a big query with request filters.

## License
The package is License under (MIT).
