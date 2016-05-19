<?php

namespace KGzocha\Searcher\Test;

use KGzocha\Searcher\CriteriaBuilder\Collection\CriteriaBuilderCollection;
use KGzocha\Searcher\Criteria\Collection\CriteriaCollection;
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

        $searcher = new Searcher(new CriteriaBuilderCollection([
            $this->getCriteriaBuilder(false, $numberOfCriteria),
            $this->getCriteriaBuilder(false, $numberOfCriteria),
            $this->getCriteriaBuilder(false, $numberOfCriteria),
            $this->getCriteriaBuilder(true, $numberOfCriteria),
            $this->getCriteriaBuilder(false, $numberOfCriteria),
            $this->getCriteriaBuilder(true, $numberOfCriteria),
            $this->getCriteriaBuilder(false, $numberOfCriteria),
        ]), $this->getSearchingContext($results));

        $result = $searcher->search(
            $this->getCriteriaCollection($numberOfCriteria)
        );

        $this->assertEquals($results, $result);
    }

    /**
     * @param bool $supportsModel
     * @param int $numberOfModels
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getCriteriaBuilder($supportsModel, $numberOfModels)
    {
        $builder = $this
            ->getMockBuilder(
                '\KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface'
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
     * @return CriteriaCollection
     */
    private function getCriteriaCollection($numberOfCriteria)
    {
        return new CriteriaCollection(array_fill(
            0,
            $numberOfCriteria,
            $this->getCriteria()
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
    private function getCriteria()
    {
        $model = $this
            ->getMockBuilder(
                '\KGzocha\Searcher\Criteria\CriteriaInterface'
            )
            ->getMock();

        $model
            ->expects($this->any())
            ->method('shouldBeApplied')
            ->willReturn(true);

        return $model;
    }
}
