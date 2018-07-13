# Create custom Specifications

To specify your own scope for query, you can create your own specification class. It has to implement 
`SpecificationInterface`.

```php
<?php
namespace App\Specifications;

use ArtemProger\Repspec\Specification\SpecificationInterface;

class ByPrice implements SpecificationInterface {

    protected $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }
    
    public function apply($builder)
    {
        $builder->where('price', '=', $this->price);
    }
}
```

Then you can use it with your repository:

```php
<?php
use App\Repositories\ProductRepository;
use App\Specifications\ByPrice;

$repository = new ProductRepository();

$product = $repository->match(new ByPrice(40.34));
```

