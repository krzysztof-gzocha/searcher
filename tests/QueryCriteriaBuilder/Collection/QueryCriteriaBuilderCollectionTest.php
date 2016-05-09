<?php

namespace KGzocha\Searcher\Test\QueryCriteriaBuilder\Collection;

use KGzocha\Searcher\QueryCriteriaBuilder\Collection\QueryCriteriaBuilderCollection;

class QueryCriteriaBuilderCollectionTest extends \PHPUnit_Framework_TestCase
{
    const NUMBER_OF_FILTER_IMPOSERS = 5;

    /**
     * @param mixed $params
     * @expectedException \InvalidArgumentException
     * @dataProvider wrongParamsDataProvider
     */
    public function testConstructorWithWrongParameter($params = null)
    {
        new QueryCriteriaBuilderCollection($params);
    }

    /**
     * @return array
     */
    public function wrongParamsDataProvider()
    {
        return [
            [0],
            [1.2],
            [new \stdClass()],
            [''],
            []
        ];
    }

    public function testConstructor()
    {
        $builders = [];

        for ($i = 1; $i <= self::NUMBER_OF_FILTER_IMPOSERS; $i++) {
            $builders[] = $this->getQueryCriteriaBuilder();
        }

        $buildersCollection = new QueryCriteriaBuilderCollection($builders);

        $this->assertCount(self::NUMBER_OF_FILTER_IMPOSERS, $buildersCollection->getQueryCriteriaBuilders());
    }

    public function testFilteringByContext()
    {
        $collection = new QueryCriteriaBuilderCollection([
            $this->getQueryCriteriaBuilderSupportingContext(true),
            $this->getQueryCriteriaBuilderSupportingContext(true),
            $this->getQueryCriteriaBuilderSupportingContext(true),
            $this->getQueryCriteriaBuilderSupportingContext(false),
            $this->getQueryCriteriaBuilderSupportingContext(false),
            $this->getQueryCriteriaBuilderSupportingContext(false),
        ]);

        $this->assertCount(3, $collection->getQueryCriteriaBuildersForContext(
            $this->getSearchingContext()
        ));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getQueryCriteriaBuilder()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param $result
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getQueryCriteriaBuilderSupportingContext($result)
    {
        $queryCriteriaBuilder = $this->getQueryCriteriaBuilder();
        $queryCriteriaBuilder
            ->expects($this->any())
            ->method('supportsSearchingContext')
            ->withAnyParameters()
            ->willReturn($result);

        return $queryCriteriaBuilder;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getSearchingContext()
    {
        return $this
            ->getMockBuilder(
                '\KGzocha\Searcher\Context\SearchingContextInterface'
            )
            ->getMock();
    }
}

