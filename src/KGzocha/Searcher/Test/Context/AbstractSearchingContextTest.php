<?php

namespace KGzocha\Searcher\Test\Context;
use KGzocha\Searcher\Context\AbstractSearchingContext;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\Context
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
            ->getMockBuilder(AbstractSearchingContext::class)
            ->setConstructorArgs([$queryBuilder])
            ->getMockForAbstractClass();
    }
}
