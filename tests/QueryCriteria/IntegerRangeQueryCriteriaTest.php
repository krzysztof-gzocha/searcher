<?php

namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\IntegerRangeQueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class IntegerRangeQueryCriteriaTest extends AbstractQueryCriteriaTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            new IntegerRangeQueryCriteria()
        );
    }

    public function testIsImposedOnEmpty()
    {
        $model = new IntegerRangeQueryCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    public function testIsImposedOnFilled()
    {
        $model = new IntegerRangeQueryCriteria();
        $model->setMin(12);
        $model->setMax(24);

        $this->assertTrue($model->shouldBeApplied());
    }

    public function testGetters()
    {
        $model = new IntegerRangeQueryCriteria();
        $model->setMin(12.765);
        $model->setMax(56.1231);

        $this->assertEquals(12, $model->getMin());
        $this->assertEquals(56, $model->getMax());
    }
}
