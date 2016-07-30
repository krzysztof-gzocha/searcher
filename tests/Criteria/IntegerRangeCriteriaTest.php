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

    public function testShouldBeAppliedByDefault()
    {
        $model = new IntegerRangeCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    /**
     * @param $min
     * @param $max
     * @param $expected
     * @dataProvider shouldBeAppliedDataProvider
     */
    public function testShouldBeApplied($min, $max, $expected)
    {
        $model = new IntegerRangeCriteria($min, $max, $expected);

        $this->assertEquals($expected, $model->shouldBeApplied());
    }

    public function shouldBeAppliedDataProvider()
    {
        return [
            [1, 2, true],

            [null, 2, false],
            [null, null, false],
            [1, null, false],
        ];
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
