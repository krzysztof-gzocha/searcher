<?php

namespace KGzocha\Searcher\Test\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollection;
use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

class QueryCriteriaCollectionTest extends \PHPUnit_Framework_TestCase
{
    const NUMBER_OF_QUERY_CRITERIA = 5;

    public function testConstructor()
    {
        $queryCriteria = [];

        for ($i = 1; $i <= self::NUMBER_OF_QUERY_CRITERIA; $i++) {
            $queryCriteria[] = $this->getQueryCriteria();
        }

        $queryCriteriaCollection = new QueryCriteriaCollection($queryCriteria);

        $this->assertCount(self::NUMBER_OF_QUERY_CRITERIA, $queryCriteriaCollection->getCriteria());
    }

    public function testCriteriaThatShouldBeApplied()
    {
        $queryCriteria = [];

        for ($i = 1; $i <= self::NUMBER_OF_QUERY_CRITERIA; $i++) {
            $queryCriteria[] = $this->getQueryCriteria();
        }

        $collection = new QueryCriteriaCollection($queryCriteria);
        $collection->addQueryCriteria($this->getQueryCriteriaThatShouldBeApplied());
        $collection->addQueryCriteria($this->getQueryCriteriaThatShouldBeApplied());

        $this->assertCount(2, $collection->getApplicableCriteria());
    }

    /**
     * @return QueryCriteriaInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getQueryCriteria()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return QueryCriteriaInterface
     */
    private function getQueryCriteriaThatShouldBeApplied()
    {
        $queryCriteria = $this->getQueryCriteria();

        $queryCriteria
            ->expects($this->any())
            ->method('shouldBeApplied')
            ->willReturn(true);

        return $queryCriteria;
    }
}

