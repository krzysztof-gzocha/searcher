<?php

namespace KGzocha\Searcher\Test\Chain;

use KGzocha\Searcher\Chain\EndTransformer;

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
        $transformer->transform([]);
    }
}
