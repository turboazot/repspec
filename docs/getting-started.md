# Basic usage examples

## Create repository

Let's create some repository class. You need to specify `$modelClass` property.

```php
<?php

namespace App\Repositories;

class FlightRepository extends Repository {

    protected $modelClass = ProductType::class;
}
```

## Retrieving models

After creating repository you can use it to retrieve all models of your class:

```php
<?php

use App\Repositories\FlightRepository;

$repository = new FlightRepository();
$flights = $repository->get();

foreach ($flights as $flight) {
    echo $flight->name;
}
```

## Adding Additional Constraints (create specification)

You may also add constraints to queries by creating specifications, and then use the `match` method to retrieve the results:

```php
$flights = $repository->match(
    Spec::andX(
        Spec::where('active', '=', 1),
        Spec::orderBy('name', 'desc'),
        Spec::limit(10)
    )
);
```

## Retrieving Single Models / Aggregates

Of course, in addition to retrieving all of the records for a given table, you may also retrieve single records
using `Spec::toSingle()` specification or `find` method:

```php
// Retrieve a model by its primary key...
$flight = $repository->find(1);
// Retrieve the first model matching the query constraints...
$flight = $repository->match(
    Spec::where('active', '=', 1),
    Act::toSingle()
);
```

You may also call the `findMany` method with an array of primary keys, which will return a collection of the 
matching records:

```php
$flight = $repository->findMany([1, 2, 3]);
```

### Retrieving Aggregates

You may also use the count, sum, max, and other aggregate methods provided by the query builder. These methods 
return the appropriate scalar value instead of a full model instance:

```php
$count = $repository->match(
    Spec::where('active', '=', 1),
    Act::count()
);

$max = $repository->match(
    Spec::where('active', '=', 1),
    Act::max('price')
);
```

## Inserting & Updating Models

## Inserts

To create a new record in the database, create a new model instance, set attributes on the model, then call the `model` repository method:

```php
<?php

namespace App\Http\Controllers;

use App\Repositories\FlightRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlightController extends Controller
{
    /**
     * Create a new flight instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, FlightRepository $repository)
    {
        // Validate the request...

        $flight = new Flight;

        $flight->name = $request->name;

        $repository->model($flight, Act::save());
    }
}
```

## Updates

```php
$flight = $repository->find(1);

$flight->name = 'New Flight Name';

$repository->model($flight, Act::save());
```

### Mass updates

```php
$repository->match(
    Spec::andX(
        Spec::where('active', '=', 1),
        Spec::where('destination', '=', 'San Diego')
    ),
    Act::updateQuery(['delayed' => 1])
);
```

## Deleting models

```php
$flight = $repository->find(1);

$repository->model($flight, Act::delete());
```
## Deleting models by query

```php
$repository->match(
    Spec::where('active', '=', 0),
    Act::delete()
);
```

## Querying Soft Deleted Models

### Including Soft Deleted Models

```php
$flights = $repository->match(
    Spec::andX(
        Spec::withTrashed(),
        Spec::where('account_id', '=', 1)
    )
);
```

### Retrieving Only Soft Deleted Models

```php
$flights = $repository->match(
    Spec::andX(
        Spec::onlyTrashed(),
        Spec::where('account_id', '=', 1)
    )
);
```

### Restoring Soft Deleted Models

```php
$repository->model($flight, Act::restore());
```

You may also use the `restore` action in a query to quickly restore multiple models

```php
$repository->match(
    Spec::andX(
        Spec::withTrashed(),
        Spec::where('airline_id', '=', 1)
    ),
    Act::restore()
);
```

This action may be also used with relation:

```php
$repository->model($flight, Act::restore('history'));
```

### Permanently Deleting Models

```php
// Force deleting a single model instance...
$repository->model($flight, Act::forceDelete());

// Force deleting all related models...
$repository->model($flight, Act::forceDelete('history'));
```

