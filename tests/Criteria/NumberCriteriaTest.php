<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\NumberCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class NumberCriteriaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $number
     * @param $expectedResult
     * @dataProvider dataProvider
     */
    public function testShouldBeApplied($number, $expectedResult)
    {
        $criteria = new NumberCriteria($number);
        $this->assertEquals($expectedResult, $criteria->shouldBeApplied());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [null, false],
            ['non-numeric', false],

            [0, true],
            [1.0, true],
            [1, true],
            [2.123, true],
        ];
    }
}
