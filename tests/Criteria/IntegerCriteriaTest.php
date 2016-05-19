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

    public function testIsImposedOnEmpty()
    {
        $model = new IntegerCriteria();
        $this->assertFalse($model->shouldBeApplied());
    }

    public function testIsImposedOnFilled()
    {
        $model = new IntegerCriteria();

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
