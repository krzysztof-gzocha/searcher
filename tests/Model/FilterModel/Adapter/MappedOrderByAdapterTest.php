<?php

namespace KGzocha\Searcher\Test\Model\FilterModel\Adapter;

use KGzocha\Searcher\Model\FilterModel\Adapter\MappedOrderByAdapter;
use KGzocha\Searcher\Model\FilterModel\OrderByFilterModel;
use KGzocha\Searcher\Test\Model\FilterModel\OrderByFilterModelTest;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class MappedOrderByAdapterTest extends OrderByFilterModelTest
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testWrongFieldMap()
    {
        new MappedOrderByAdapter(new OrderByFilterModel(), 'abc');
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
