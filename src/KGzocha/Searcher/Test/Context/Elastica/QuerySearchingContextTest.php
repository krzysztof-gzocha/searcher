<?php

namespace KGzocha\Searcher\Test\Context\Elastica;

use Elastica\Query;
use Elastica\ResultSet;
use Elastica\Search;
use KGzocha\Searcher\Context\Elastica\QuerySearchingContext;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package Context\Elastica
 */
class QuerySearchingContextTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor(Query $query = null)
    {
        $context = new QuerySearchingContext(
            $search = $this->getSearchMock(),
            $query
        );

        $this->assertInstanceOf(
            Query::class,
            $context->getQueryBuilder()
        );

        $this->assertInstanceOf(
            ResultSet::class,
            $context->getResults()
        );

        $this->assertEquals($search, $context->getSearch());
    }

    public function dataProviderForTestingConstructor()
    {
        return [
            [new Query()],
            [null]
        ];
    }

    /**
     * @return Search|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getSearchMock()
    {
        $search = $this
            ->getMockBuilder(Search::class)
            ->disableOriginalConstructor()
            ->getMock();

        $resultSet = $this
            ->getMockBuilder(ResultSet::class)
            ->disableOriginalConstructor()
            ->getMock();

        $search
            ->expects($this->once())
            ->method('search')
            ->willReturn($resultSet);

        return $search;
    }
}
