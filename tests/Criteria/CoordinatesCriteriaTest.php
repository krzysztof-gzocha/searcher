<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\CoordinatesCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class CoordinatesCriteriaTest extends AbstractCriteriaTestCase
{
    public function testIsImposedOnEmpty()
    {
        $model = new CoordinatesCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    public function testIsImposedOnFilled()
    {
        $model = new CoordinatesCriteria();
        $model->setLatitude(12.34567);
        $model->setLongitude(76.54321);

        $this->assertTrue($model->shouldBeApplied());
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(new CoordinatesCriteria());
    }
}
