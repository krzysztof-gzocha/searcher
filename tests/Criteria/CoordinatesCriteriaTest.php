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
        $model->setLatitude($latitude = 12.34567);
        $model->setLongitude($longitude = 76.54321);

        $this->assertTrue($model->shouldBeApplied());
        $this->assertEquals($latitude, $model->getLatitude());
        $this->assertEquals($longitude, $model->getLongitude());
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(new CoordinatesCriteria());
    }
}
