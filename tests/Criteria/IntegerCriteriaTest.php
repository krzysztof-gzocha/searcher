<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\IntegerCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class IntegerCriteriaTest extends AbstractCriteriaTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            new IntegerCriteria()
        );
    }

    public function testShouldBeAppliedByDefault()
    {
        $model = new IntegerCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    /**
     * @param int $integer
     * @param $expected
     * @dataProvider shouldBeAppliedDataProvider
     */
    public function testShouldBeApplied($integer, $expected)
    {
        $model = new IntegerCriteria($integer);
        $this->assertEquals($expected, $model->shouldBeApplied());
    }

    /**
     * @return array
     */
    public function shouldBeAppliedDataProvider()
    {
        return [
            [10, true],
            ['1a', true],
            [10.12, true],
            ['10.12', true],

            [null, false],
        ];
    }

    public function testGetters()
    {
        $model = new IntegerCriteria();

        $model->setInteger(10);
        $this->assertEquals(10, $model->getInteger());

        $model->setInteger('10.72');
        $this->assertEquals(10, $model->getInteger());

        $model->setInteger(10.53412);
        $this->assertEquals(10, $model->getInteger());

        $model->setInteger(null);
        $this->assertEquals(0, $model->getInteger());
    }
}
