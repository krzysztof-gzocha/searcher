<?php

namespace KGzocha\Searcher\Test\Chain;

use KGzocha\Searcher\Chain\Cell;
use KGzocha\Searcher\Chain\EndTransformer;
use KGzocha\Searcher\Chain\TransformerInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class CellTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $searcher = $this->getSearcher();
        $transformer = $this->getTransformer();

        $cell = new Cell($searcher, $transformer);

        $this->assertEquals($searcher, $cell->getSearcher());
        $this->assertEquals($transformer, $cell->getTransformer());
    }

    /**
     * @dataProvider hasTransformerDataProvider
     *
     * @param TransformerInterface $transformer
     * @param bool                 $expected
     */
    public function testHasTransformer(TransformerInterface $transformer, $expected)
    {
        $cell = new Cell($this->getSearcher(), $transformer);

        $this->assertEquals($expected, $cell->hasTransformer());
    }

    /**
     * @return array
     */
    public function hasTransformerDataProvider()
    {
        return [
            [new EndTransformer(), false],
            [$this->getTransformer(), true],
        ];
    }

    /**
     * @return \KGzocha\Searcher\Searcher|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getSearcher()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\SearcherInterface')
            ->getMock();
    }

    /**
     * @return \KGzocha\Searcher\Chain\TransformerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getTransformer()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\Chain\TransformerInterface')
            ->getMock();
    }
}
