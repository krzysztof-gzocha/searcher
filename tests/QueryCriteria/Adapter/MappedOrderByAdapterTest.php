<?php

namespace KGzocha\Searcher\Test\QueryCriteria\Adapter;

use KGzocha\Searcher\QueryCriteria\Adapter\MappedOrderByAdapter;
use KGzocha\Searcher\QueryCriteria\OrderByQueryCriteria;
use KGzocha\Searcher\Test\QueryCriteria\OrderByQueryCriteriaTest;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class MappedOrderByAdapterTest extends OrderByQueryCriteriaTest
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWrongFieldMap()
    {
        new MappedOrderByAdapter(new OrderByQueryCriteria(), 'abc');
    }

    public function testGettingHiddenValues()
    {
        $model = $this->getFilterModel();
        $model->setOrderBy('thisIWantToShow');
        $this->assertEquals('thisIsHiddenFromUser', $model->getMappedOrderBy());
    }

    public function testRawValueOutOfMappedFields()
    {
        $model = $this->getFilterModel();
        $model->setOrderBy('someValueOutOfRange');
        $this->assertNull($model->getMappedOrderBy());
    }

    public function testAccessToFieldMap()
    {
        $model = $this->getFilterModel();
        $this->assertEquals($this->getMappedFields(), $model->getFieldsMap());
    }

    /**
     * @inheritDoc
     */
    protected function getFilterModel($defaultOrderBy = null)
    {
        return new MappedOrderByAdapter(
            parent::getFilterModel($defaultOrderBy),
            $this->getMappedFields()
        );
    }

    /**
     * @return array
     */
    private function getMappedFields()
    {
        return [
            // values from OrderByFilterModelTest
            'value' => 'p.id',
            'someValue' => 'a.id',
            'anything' => 'p.id',
            'pid' => 'people.id',
            'thisIWantToShow' => 'thisIsHiddenFromUser',
        ];
    }
}
