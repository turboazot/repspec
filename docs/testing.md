# Testing specifications

For testing retrieving logic, we can extract the method that returns a specification for controller's action:

```php
<?php

namespace App\Http\Controllers;

use App\Flight;
use App\Http\Controllers\Controller;
use App\Repositories\FlightRepository;
use ArtemProger\Repspec\Specification\Spec;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    protected $repository;

    public function __construct(FlightRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $orderBy = $request->query('order-by');
        $orderType = $request->query('order-type');

        $spec = $this->getFlightsSpec($filter, $orderBy, $orderType);

        $users = $this->repository->match($spec);

        return new JsonResponse(['data' => $users]);
    }

    // Now we can easily test this method
    public function getFlightsSpec($filter, $orderBy, $orderType) {

        $spec = Spec::andX(
            Spec::when($filter['active'], [
                Spec::where('active', '=', 1)
            ]),
            Spec::orderBy($orderBy, $orderType)
        );

        // Or instead of using When, you can conditionally attach specifications
        if ($spec['age']) {
            $spec->addChild(Spec::where('age', '=', 1));
        }

        return $spec;
    }
}
```
Specifications have their own getters for children, values or operators, so we can easily test it. This is a simple example of testing our specification logic.

```php
<?php

namespace App\Tests;

use App\Flight;
use App\Http\Controllers\Controller;
use App\Repositories\FlightRepository;
use ArtemProger\Repspec\Specification\Filter\When;
use ArtemProger\Repspec\Specification\Filter\Where;
use ArtemProger\Repspec\Specification\Spec;
use PHPUnit\Framework\TestCase;

class TestFlightController extends TestCase {

    private function getController()
    {
        $repositoryMock = $this->createMock(FlightRepository::class);

        return new FlightController($repositoryMock);
    }

    public function testGetFlightSpecWithActiveFilterOnly()
    {

        $inputFilter = [
            'active' => 1
        ];

        $resultSpec = $this->getController()->getFlightsSpec($inputFilter);

        $specChildren = $resultSpec->getChildren();

        $this->assertCount(1, $specChildren);
        $this->assertArrayHasKey(0, $specChildren);

        /**
         * @var $whenSpec When
         */
        $whenSpec = $resultSpec->getChildren()[0];
        $whenChildren = $whenSpec->getChildren();

        $this->assertCount(1, $whenChildren);
        $this->assertArrayHasKey(0, $whenChildren);

        /**
         * @var $whereSpec Where
         */
        $whereSpec = $whenChildren[0];

        $this->assertEquals(1, $whereSpec->getColumn());
        $this->assertEquals('=', $whereSpec->getOperator());
        $this->assertEquals('active', $whereSpec->getValue());
        $this->assertInstanceOf(When::class, $whenSpec[0]);
    }
}
```

