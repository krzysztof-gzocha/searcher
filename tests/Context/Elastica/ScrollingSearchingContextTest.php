<?php

namespace KGzocha\Searcher\Test\Context\Elastica;

use Elastica\Query;
use Elastica\Scroll;
use Elastica\Search;
use KGzocha\Searcher\Context\Elastica\ScrollingSearchingContext;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ScrollingSearchingContextTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor(Query $query = null, $expiryTime = '1m')
    {
        $context = new ScrollingSearchingContext(
            $search = $this->getSearchMock($expiryTime),
            $query,
            $expiryTime
        );

        $this->assertInstanceOf(
            '\Elastica\Query',
            $context->getQueryBuilder()
        );

        $this->assertInstanceOf(
            '\Elastica\Scroll',
            $result = $context->getResults()
        );

        $this->assertEquals($search, $context->getSearch());
        $this->assertEquals($expiryTime, $result->expiryTime);
    }

    public function dataProviderForTestingConstructor()
    {
        return [
            [new Query(), '1m'],
            [new Query(), '2m'],
            [null, '1m'],
            [null, '3m'],
        ];
    }

    /**
     * @return Search|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getSearchMock($expiryTime = '1m')
    {
        $search = $this
            ->getMockBuilder('\Elastica\Search')
            ->disableOriginalConstructor()
            ->getMock();

        $scroll = new Scroll($search, $expiryTime);

        $search
            ->expects($this->once())
            ->method('scroll')
            ->willReturn($scroll);

        return $search;
    }
}
