<?php

namespace KGzocha\Searcher\Test\Criteria\Collection;

use KGzocha\Searcher\Criteria\Collection\NamedCriteriaCollection;

class NamedCriteriaCollectionTest extends CriteriaCollectionTest
{
    public function testMagicMethods()
    {
        $criteria = $this->getCriteria();
        $collection = new NamedCriteriaCollection();
        $collection->crtieria1 = $criteria;
        $collection->crtieria2 = $criteria;

        $this->assertEquals(
            $criteria,
            $collection->crtieria1
        );
        $this->assertEquals(
            $criteria,
            $collection->crtieria2
        );
    }

    public function testNonMagicMethods()
    {
        $criteria = $this->getCriteria();
        $collection = new NamedCriteriaCollection();
        $collection->addNamedCriteria('test1', $criteria);
        $collection->addNamedCriteria('test2', $criteria);
        $collection->addNamedCriteria('test3', $criteria);
        $collection->addNamedCriteria('test3', $criteria); // Duplicate

        $this->assertCount(3, $collection->getCriteria());
    }

    public function testMissingCriteria()
    {
        $collection = new NamedCriteriaCollection();

        $this->assertEmpty($collection->getNamedCriteria('non-existing-criteria'));
    }

    public function testFluentInterface()
    {
        $collection = new NamedCriteriaCollection();
        $this->assertInstanceOf(
            '\KGzocha\Searcher\Criteria\Collection\NamedCriteriaCollection',
            $collection->addCriteria($this->getCriteria())
        );
        $this->assertInstanceOf(
            '\KGzocha\Searcher\Criteria\Collection\NamedCriteriaCollection',
            $collection->addNamedCriteria('name', $this->getCriteria())
        );
    }
}
