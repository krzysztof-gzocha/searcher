<?php

namespace KGzocha\Searcher\Test\FilterModel;

use KGzocha\Searcher\FilterModel\IntegerRangeFilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class IntegerRangeFilterModelTest extends AbstractFilterModelTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            new IntegerRangeFilterModel()
        );
    }

    public function testIsImposedOnEmpty()
    {
        $model = new IntegerRangeFilterModel();
        $this->assertFalse($model->isImposed());
    }

    public function testIsImposedOnFilled()
    {
        $model = new IntegerRangeFilterModel();
        $model->setMin(12);
        $model->setMax(24);

        $this->assertTrue($model->isImposed());
    }

    public function testGetters()
    {
        $model = new IntegerRangeFilterModel();
        $model->setMin(12.765);
        $model->setMax(56.1231);

        $this->assertEquals(12, $model->getMin());
        $this->assertEquals(56, $model->getMax());
    }
}
