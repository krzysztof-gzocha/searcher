<?php

namespace KGzocha\Searcher\Test\FilterModel;
use KGzocha\Searcher\FilterModel\IntegerFilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
class IntegerFilterModelTest extends AbstractFilterModelTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            new IntegerFilterModel()
        );
    }

    public function testIsImposedOnEmpty()
    {
        $model = new IntegerFilterModel();
        $this->assertFalse($model->isImposed());
    }

    public function testIsImposedOnFilled()
    {
        $model = new IntegerFilterModel();

        $model->setInteger(10);
        $this->assertTrue($model->isImposed());

        $model->setInteger('1a');
        $this->assertTrue($model->isImposed());

        $model->setInteger(10.12);
        $this->assertTrue($model->isImposed());

        $model->setInteger('100.32');
        $this->assertTrue($model->isImposed());
    }

    public function testGetters()
    {
        $model = new IntegerFilterModel();

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
