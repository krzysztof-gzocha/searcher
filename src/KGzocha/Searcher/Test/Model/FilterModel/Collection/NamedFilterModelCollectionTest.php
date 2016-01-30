<?php

namespace KGzocha\Searcher\Test\Model\FilterModel\Collection;

use KGzocha\Searcher\Model\FilterModel\Collection\FilterModelCollection;
use KGzocha\Searcher\Model\FilterModel\Collection\NamedFilterModelCollection;
use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;

class NamedFilterModelCollectionTest extends FilterModelCollectionTest
{
    public function testMagicMethods()
    {
        $filterModel = $this->getFilterModel();
        $collection = new NamedFilterModelCollection();
        $collection->filterModel1 = $filterModel;
        $collection->filterModel2 = $filterModel;
        $this->assertEquals(
            $filterModel,
            $collection->filterModel1
        );
        $this->assertEquals(
            $filterModel,
            $collection->filterModel2
        );
    }

    public function testNonMagicMethods()
    {
        $filterModel = $this->getFilterModel();
        $collection = new NamedFilterModelCollection();
        $collection->addNamedFilterModel('test1', $filterModel);
        $collection->addNamedFilterModel('test2', $filterModel);
        $collection->addNamedFilterModel('test3', $filterModel);
        $collection->addNamedFilterModel('test3', $filterModel); // Duplicate

        $this->assertCount(3, $collection->getFilterModels());
    }
}

