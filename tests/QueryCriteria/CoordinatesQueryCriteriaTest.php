<?php

namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\CoordinatesQueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class CoordinatesQueryCriteriaTest extends AbstractQueryCriteriaTestCase
{
    public function testIsImposedOnEmpty()
    {
        $model = new CoordinatesQueryCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    public function testIsImposedOnFilled()
    {
        $model = new CoordinatesQueryCriteria();
        $model->setLatitude(12.34567);
        $model->setLongitude(76.54321);

        $this->assertTrue($model->shouldBeApplied());
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(new CoordinatesQueryCriteria());
    }
}
