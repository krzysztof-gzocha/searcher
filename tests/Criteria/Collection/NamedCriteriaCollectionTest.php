<?php

namespace KGzocha\Searcher\Test\Criteria\Collection;

use KGzocha\Searcher\Criteria\Collection\NamedCriteriaCollection;

class NamedCriteriaCollectionTest extends CriteriaCollectionTest
{
    public function testMagicMethods()
    {
        $filterModel = $this->getCriteria();
        $collection = new NamedCriteriaCollection();
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
        $filterModel = $this->getCriteria();
        $collection = new NamedCriteriaCollection();
        $collection->addNamedCriteria('test1', $filterModel);
        $collection->addNamedCriteria('test2', $filterModel);
        $collection->addNamedCriteria('test3', $filterModel);
        $collection->addNamedCriteria('test3', $filterModel); // Duplicate

        $this->assertCount(3, $collection->getCriteria());
    }
}

