<?php

namespace KGzocha\Searcher\Test\Context;

use KGzocha\Searcher\Context\FinderSearchingContext;
use Symfony\Component\Finder\Finder;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class FinderSearchingContextTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildDefault()
    {
        $context = FinderSearchingContext::buildDefault();
        $this->assertInstanceOf(
            'KGzocha\Searcher\Context\FinderSearchingContext',
            $context
        );
    }

    /**
     * @param FinderSearchingContext $context
     * @depends testBuildDefault
     * @dataProvider contextDataProvider
     */
    public function testGetQueryBuilder(FinderSearchingContext $context)
    {
        $this->assertInstanceOf(
            'Symfony\Component\Finder\Finder',
            $context->getQueryBuilder()
        );
    }

    /**
     * @param FinderSearchingContext $context
     * @depends testGetQueryBuilder
     * @dataProvider contextDataProvider
     */
    public function testGetResults(FinderSearchingContext $context)
    {
        $context->getQueryBuilder()->in(__DIR__);

        $this->assertInstanceOf(
            '\Iterator',
            $context->getResults()
        );
    }

    /**
     * @return array
     */
    public function contextDataProvider()
    {
        return [
            [new FinderSearchingContext(new Finder())],
            [FinderSearchingContext::buildDefault()]
        ];
    }
}
