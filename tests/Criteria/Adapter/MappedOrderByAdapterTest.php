<?php

namespace KGzocha\Searcher\Test\Criteria\Adapter;

use KGzocha\Searcher\Criteria\Adapter\MappedOrderByAdapter;
use KGzocha\Searcher\Criteria\OrderByCriteria;
use KGzocha\Searcher\Test\Criteria\OrderByCriteriaTest;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class MappedOrderByAdapterTest extends OrderByCriteriaTest
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWrongFieldMap()
    {
        new MappedOrderByAdapter(new OrderByCriteria(), 'abc');
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
