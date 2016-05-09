<?php

namespace KGzocha\Searcher\Test\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\Collection\NamedQueryCriteriaCollection;

class NamedQueryCriteriaCollectionTest extends QueryCriteriaCollectionTest
{
    public function testMagicMethods()
    {
        $filterModel = $this->getQueryCriteria();
        $collection = new NamedQueryCriteriaCollection();
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
        $filterModel = $this->getQueryCriteria();
        $collection = new NamedQueryCriteriaCollection();
        $collection->addNamedQueryCriteria('test1', $filterModel);
        $collection->addNamedQueryCriteria('test2', $filterModel);
        $collection->addNamedQueryCriteria('test3', $filterModel);
        $collection->addNamedQueryCriteria('test3', $filterModel); // Duplicate

        $this->assertCount(3, $collection->getCriteria());
    }
}

