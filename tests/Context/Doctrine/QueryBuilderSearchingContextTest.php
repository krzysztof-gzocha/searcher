<?php

namespace KGzocha\Searcher\Test\Context\Doctrine;

use Doctrine\ORM\QueryBuilder;
use KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext;
use KGzocha\Searcher\Test\Context\QueryStub;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class QueryBuilderSearchingContextTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $context = new QueryBuilderSearchingContext(
            $queryBuilder = $this->getQueryBuilderMock()
        );

        $this->assertEquals(
            $queryBuilder,
            $context->getQueryBuilder()
        );
    }

    public function testResults()
    {
        $context = new QueryBuilderSearchingContext(
            $this->getQueryBuilderMock($results = [1, 2, 3])
        );

        $this->assertEquals(
            $results,
            $context->getResults()
        );
    }

    /**
     * @param array $results
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|QueryBuilder
     */
    private function getQueryBuilderMock(array $results = [])
    {
        $mock = $this
            ->getMockBuilder('\Doctrine\ORM\QueryBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $mock
            ->expects($this->any())
            ->method('getQuery')
            ->willReturn(new QueryStub($results));

        return $mock;
    }
}
