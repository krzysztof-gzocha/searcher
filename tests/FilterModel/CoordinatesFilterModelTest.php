<?php

namespace KGzocha\Searcher\Test\FilterModel;

use KGzocha\Searcher\FilterModel\CoordinatesFilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class CoordinatesFilterModelTest extends AbstractFilterModelTestCase
{
    public function testIsImposedOnEmpty()
    {
        $model = new CoordinatesFilterModel();
        $this->assertFalse($model->isImposed());
    }

    public function testIsImposedOnFilled()
    {
        $model = new CoordinatesFilterModel();
        $model->setLatitude(12.34567);
        $model->setLongitude(76.54321);

        $this->assertTrue($model->isImposed());
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(new CoordinatesFilterModel());
    }
}
