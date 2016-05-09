<?php

namespace KGzocha\Searcher\Test;

use KGzocha\Searcher\QueryCriteriaBuilder\Collection\QueryCriteriaBuilderCollection;
use KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollection;
use KGzocha\Searcher\Searcher;

/**
 * @author Krzysztof Gzocha
 * @package KGzocha\Searcher\Test\Searcher
 */
class SearcherTest extends \PHPUnit_Framework_TestCase
{
    public function testSearchMethod()
    {
        $numberOfCriteria = 1;
        $results = [1, 2, 3, 4];

        $searcher = new Searcher(new QueryCriteriaBuilderCollection([
            $this->getQueryCriteriaBuilder(false, $numberOfCriteria),
            $this->getQueryCriteriaBuilder(false, $numberOfCriteria),
            $this->getQueryCriteriaBuilder(false, $numberOfCriteria),
            $this->getQueryCriteriaBuilder(true, $numberOfCriteria),
            $this->getQueryCriteriaBuilder(false, $numberOfCriteria),
            $this->getQueryCriteriaBuilder(true, $numberOfCriteria),
            $this->getQueryCriteriaBuilder(false, $numberOfCriteria),
        ]), $this->getSearchingContext($results));

        $result = $searcher->search(
            $this->getQueryCriteriaCollection($numberOfCriteria)
        );

        $this->assertEquals($results, $result);
    }

    /**
     * @param bool $supportsModel
     * @param int $numberOfModels
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getQueryCriteriaBuilder($supportsModel, $numberOfModels)
    {
        $builder = $this
            ->getMockBuilder(
                '\KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface'
            )
            ->getMock();

        $builder
            ->expects($this->exactly($numberOfModels))
            ->method('allowsCriteria')
            ->willReturn($supportsModel);

        $builder
            ->expects($this->exactly($numberOfModels))
            ->method('supportsSearchingContext')
            ->willReturn(true);

        $builder
            ->expects(
                $supportsModel
                    ? $this->exactly($numberOfModels)
                    : $this->never()
            )
            ->method('buildCriteria');

        return $builder;
    }

    /**
     * @param int $numberOfCriteria
     *
     * @return QueryCriteriaCollection
     */
    private function getQueryCriteriaCollection($numberOfCriteria)
    {
        return new QueryCriteriaCollection(array_fill(
            0,
            $numberOfCriteria,
            $this->getQueryCriteria()
        ));
    }

    /**
     * @param $result
     *
     * @return \KGzocha\Searcher\Context\SearchingContextInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getSearchingContext($result)
    {
        $context = $this
            ->getMock('\KGzocha\Searcher\Context\SearchingContextInterface');

        $context
            ->expects($this->once())
            ->method('getResults')
            ->willReturn($result);

        return $context;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getQueryCriteria()
    {
        $model = $this
            ->getMockBuilder(
                '\KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface'
            )
            ->getMock();

        $model
            ->expects($this->any())
            ->method('shouldBeApplied')
            ->willReturn(true);

        return $model;
    }
}
