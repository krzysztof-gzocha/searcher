<?php

namespace KGzocha\Searcher\Test\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\Event\Dispatcher\EventDispatcher;
use KGzocha\Searcher\FilterImposer\Collection\FilterImposerCollection;
use KGzocha\Searcher\FilterImposer\FilterImposerInterface;
use KGzocha\Searcher\Model\FilterModel\Collection\FilterModelCollection;
use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;
use KGzocha\Searcher\Searcher\Searcher;

/**
 * @author Krzysztof Gzocha
 * @package KGzocha\Searcher\Test\Searcher
 */
class SearcherTest extends \PHPUnit_Framework_TestCase
{
    public function testSearchMethod()
    {
        $numberOfModels = 1;
        $searcher = new Searcher(new FilterImposerCollection([
            $this->getFilterImposer(false, $numberOfModels),
            $this->getFilterImposer(false, $numberOfModels),
            $this->getFilterImposer(false, $numberOfModels),
            $this->getFilterImposer(true, $numberOfModels),
            $this->getFilterImposer(false, $numberOfModels),
            $this->getFilterImposer(true, $numberOfModels),
            $this->getFilterImposer(false, $numberOfModels),
        ]), new EventDispatcher());

        $results = [1,2,3,4];
        $result = $searcher->search(
            $this->getFilterModelCollection($numberOfModels),
            $this->getSearchingContext($results)
        );

        $this->assertEquals($results, $result);
    }

    /**
     * @param bool $supportsModel
     * @param int  $numberOfModels
     * @return FilterImposerInterface
     */
    private function getFilterImposer($supportsModel, $numberOfModels)
    {
        $imposer = $this
            ->getMockBuilder(FilterImposerInterface::class)
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
            ->expects($supportsModel ? $this->exactly($numberOfModels) : $this->never())
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
     * @param mixed $result
     * @return SearchingContextInterface
     */
    private function getSearchingContext($result)
    {
        $context = $this
            ->getMock(SearchingContextInterface::class);

        $context
            ->expects($this->once())
            ->method('getResults')
            ->willReturn($result);

        return $context;
    }

    private function getImposedFilterModel()
    {
        $model = $this
            ->getMockBuilder(FilterModelInterface::class)
            ->getMock();

        $model
            ->expects($this->any())
            ->method('isImposed')
            ->willReturn(true);

        return $model;
    }
}
