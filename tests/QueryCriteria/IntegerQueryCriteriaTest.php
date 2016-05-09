<?php

namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\IntegerQueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class IntegerQueryCriteriaTest extends AbstractQueryCriteriaTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            new IntegerQueryCriteria()
        );
    }

    public function testIsImposedOnEmpty()
    {
        $model = new IntegerQueryCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    public function testIsImposedOnFilled()
    {
        $model = new IntegerQueryCriteria();

        $model->setInteger(10);
        $this->assertTrue($model->shouldBeApplied());

        $model->setInteger('1a');
        $this->assertTrue($model->shouldBeApplied());

        $model->setInteger(10.12);
        $this->assertTrue($model->shouldBeApplied());

        $model->setInteger('100.32');
        $this->assertTrue($model->shouldBeApplied());
    }

    public function testGetters()
    {
        $model = new IntegerQueryCriteria();

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
