<?php

namespace KGzocha\Searcher\Test;

use KGzocha\Searcher\FilterModel\Collection\FilterModelCollection;
use KGzocha\Searcher\WrappedResultsSearcher;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class WrappedResultsSearcherTest extends \PHPUnit_Framework_TestCase
{
    public function testWrappingResults()
    {
        $searcher = new WrappedResultsSearcher($this->getSearcher([
            new \stdClass(),
            new \stdClass(),
            new \stdClass(),
        ]));
        $results = $searcher->search(new FilterModelCollection());
        $this->assertInstanceOf('KGzocha\Searcher\Result\ResultCollection', $results);
        $this->assertCount(3, $results);
    }

    private function getSearcher($results = [])
    {
        $searcher = $this
            ->getMockBuilder('KGzocha\Searcher\Searcher')
            ->disableOriginalConstructor()
            ->getMock();

        $searcher
            ->expects($this->once())
            ->method('search')
            ->willReturn($results);

        return $searcher;
    }
}
