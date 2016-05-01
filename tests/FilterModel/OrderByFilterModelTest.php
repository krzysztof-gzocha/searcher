<?php

namespace KGzocha\Searcher\Test\FilterModel;

use KGzocha\Searcher\FilterModel\OrderByFilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class OrderByFilterModelTest extends AbstractFilterModelTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface($this->getFilterModel());
    }

    public function testImposedWithoutValue()
    {
        $this->assertFalse($this->getFilterModel()->isImposed());
        $this->assertFalse($this->getFilterModel('')->isImposed());

        $model = $this->getFilterModel('value');
        $model->setOrderBy('');
        $this->assertFalse($model->isImposed());
    }

    public function testImposedWithValue()
    {
        $this->assertTrue($this->getFilterModel('someValue')->isImposed());
        $this->assertTrue($this->getFilterModel('anything')->isImposed());

        $model = $this->getFilterModel();
        $model->setOrderBy('value');
        $this->assertTrue($model->isImposed());
    }

    /**
     * @param null $defaultOrderBy
     *
     * @return OrderByFilterModel
     */
    protected function getFilterModel($defaultOrderBy = null)
    {
        return new OrderByFilterModel($defaultOrderBy);
    }
}
