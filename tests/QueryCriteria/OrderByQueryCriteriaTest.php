<?php

namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\OrderByQueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class OrderByQueryCriteriaTest extends AbstractQueryCriteriaTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface($this->getFilterModel());
    }

    public function testImposedWithoutValue()
    {
        $this->assertFalse($this->getFilterModel()->shouldBeApplied());
        $this->assertFalse($this->getFilterModel('')->shouldBeApplied());

        $model = $this->getFilterModel('value');
        $model->setOrderBy('');
        $this->assertFalse($model->shouldBeApplied());
    }

    public function testImposedWithValue()
    {
        $this->assertTrue($this->getFilterModel('someValue')->shouldBeApplied());
        $this->assertTrue($this->getFilterModel('anything')->shouldBeApplied());

        $model = $this->getFilterModel();
        $model->setOrderBy('value');
        $this->assertTrue($model->shouldBeApplied());
    }

    /**
     * @param null $defaultOrderBy
     *
     * @return OrderByQueryCriteria
     */
    protected function getFilterModel($defaultOrderBy = null)
    {
        return new OrderByQueryCriteria($defaultOrderBy);
    }
}
