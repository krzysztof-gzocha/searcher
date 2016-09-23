<?php

namespace KGzocha\Searcher\Test\Context;

use KGzocha\Searcher\Context\AbstractSearchingContext;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class AbstractSearchingContextTest extends \PHPUnit_Framework_TestCase
{
    public function testGetQueryBuilderMethod()
    {
        $queryBuilder = new \stdClass();
        $context = $this->getSearchingContext($queryBuilder);

        $this->assertEquals($queryBuilder, $context->getQueryBuilder());
    }

    /**
     * @param mixed $queryBuilder
     *
     * @return AbstractSearchingContext
     */
    private function getSearchingContext($queryBuilder)
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\Context\AbstractSearchingContext')
            ->setConstructorArgs([$queryBuilder])
            ->getMockForAbstractClass();
    }
}
