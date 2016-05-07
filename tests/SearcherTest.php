<?php

namespace KGzocha\Searcher\Test;

use KGzocha\Searcher\FilterImposer\Collection\FilterImposerCollection;
use KGzocha\Searcher\FilterModel\Collection\FilterModelCollection;
use KGzocha\Searcher\Searcher;

/**
 * @author Krzysztof Gzocha
 * @package KGzocha\Searcher\Test\Searcher
 */
class SearcherTest extends \PHPUnit_Framework_TestCase
{
    public function testSearchMethod()
    {
        $numberOfModels = 1;
        $results = [1, 2, 3, 4];

        $searcher = new Searcher(new FilterImposerCollection([
            $this->getFilterImposer(false, $numberOfModels),
            $this->getFilterImposer(false, $numberOfModels),
            $this->getFilterImposer(false, $numberOfModels),
            $this->getFilterImposer(true, $numberOfModels),
            $this->getFilterImposer(false, $numberOfModels),
            $this->getFilterImposer(true, $numberOfModels),
            $this->getFilterImposer(false, $numberOfModels),
        ]), $this->getSearchingContext($results));

        $result = $searcher->search(
            $this->getFilterModelCollection($numberOfModels)
        );

        $this->assertEquals($results, $result);
    }

    /**
     * @param bool $supportsModel
     * @param int $numberOfModels
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getFilterImposer($supportsModel, $numberOfModels)
    {
        $imposer = $this
            ->getMockBuilder(
                '\KGzocha\Searcher\FilterImposer\FilterImposerInterface'
            )
            ->getMock();

        $imposer
            ->expects($this->exactly($numberOfModels))
            ->method('supportsModel')
            ->willReturn($supportsModel);

        $imposer
            ->expects($this->exactly($numberOfModels))
            ->method('supportsSearchingContext')
            ->willReturn(true);

        $imposer
            ->expects(
                $supportsModel
                    ? $this->exactly($numberOfModels)
                    : $this->never()
            )
            ->method('imposeFilter');

        return $imposer;
    }

    /**
     * @param int $numberOfModels
     *
     * @return FilterModelCollection
     */
    private function getFilterModelCollection($numberOfModels)
    {
        return new FilterModelCollection(array_fill(
            0,
            $numberOfModels,
            $this->getImposedFilterModel()
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
    private function getImposedFilterModel()
    {
        $model = $this
            ->getMockBuilder(
                '\KGzocha\Searcher\FilterModel\FilterModelInterface'
            )
            ->getMock();

        $model
            ->expects($this->any())
            ->method('isImposed')
            ->willReturn(true);

        return $model;
    }
}
