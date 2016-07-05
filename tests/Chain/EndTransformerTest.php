<?php

namespace KGzocha\Searcher\Test\Chain;

use KGzocha\Searcher\Chain\EndTransformer;
use KGzocha\Searcher\Criteria\Collection\CriteriaCollection;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class EndTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testSkipMethod()
    {
        $transformer = new EndTransformer();
        $this->assertFalse($transformer->skip([]));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testTransformMethod()
    {
        $transformer = new EndTransformer();
        $transformer->transform([], new CriteriaCollection());
    }
}
