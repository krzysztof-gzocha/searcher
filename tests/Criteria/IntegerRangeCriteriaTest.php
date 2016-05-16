<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\IntegerRangeCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class IntegerRangeCriteriaTest extends AbstractCriteriaTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            new IntegerRangeCriteria()
        );
    }

    public function testIsImposedOnEmpty()
    {
        $model = new IntegerRangeCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    public function testIsImposedOnFilled()
    {
        $model = new IntegerRangeCriteria();
        $model->setMin(12);
        $model->setMax(24);

        $this->assertTrue($model->shouldBeApplied());
    }

    public function testGetters()
    {
        $model = new IntegerRangeCriteria();
        $model->setMin(12.765);
        $model->setMax(56.1231);

        $this->assertEquals(12, $model->getMin());
        $this->assertEquals(56, $model->getMax());
    }
}
