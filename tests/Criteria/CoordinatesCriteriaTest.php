<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\CoordinatesCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class CoordinatesCriteriaTest extends AbstractCriteriaTestCase
{
    public function testShouldBeAppliedByDefault()
    {
        $model = new CoordinatesCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    /**
     * @param $lat
     * @param $lon
     * @param $expected
     * @dataProvider shouldBeAppliedDataProvider
     */
    public function testShouldBeApplied($lat, $lon, $expected)
    {
        $model = new CoordinatesCriteria($lat, $lon);

        $this->assertEquals($expected, $model->shouldBeApplied());
    }

    public function shouldBeAppliedDataProvider()
    {
        return [
            [23.123, 56.566, true],
            [null, null, false],
            [23.123, null, false],
            [null, 56.123, false],
        ];
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(new CoordinatesCriteria());
    }
}
