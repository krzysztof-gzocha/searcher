<?php

namespace KGzocha\Searcher\Test\Chain;

use KGzocha\Searcher\Chain\Cell;
use KGzocha\Searcher\Chain\ChainSearch;
use KGzocha\Searcher\Chain\EndTransformer;
use KGzocha\Searcher\Criteria\Collection\CriteriaCollection;
use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ChainSearchTest extends \PHPUnit_Framework_TestCase
{
    public function testResultKeys()
    {
        $startingCriteria = new CriteriaCollection();
        $secondCriteria = new CriteriaCollection();
        $thirdCriteria = new CriteriaCollection();

        $cells = [
            new Cell(
                $this->getSearcher($startingCriteria, [1,2,3]),
                $this->getTransformer([1,2,3], $secondCriteria),
                'first'
            ),
            new Cell(
                $this->getSearcher($secondCriteria, [4,5,6]),
                $this->getTransformer([4,5,6], $thirdCriteria),
                'second'
            ),
            new Cell(
                $this->getSearcher($thirdCriteria, [7,8,9]), 
                new EndTransformer(),
                'third'
            ),
        ];

        $chain = new ChainSearch($cells);
        $results = $chain->search($startingCriteria);

        $this->assertCount(count($cells), $results);
        $this->assertEquals(
            ['first', 'second', 'third'],
            array_keys($results->getResults())
        );
        $this->assertEquals([
            'first' => [1,2,3],
            'second' => [4,5,6],
            'third' => [7,8,9],
        ], $results->getResults());
    }

    public function testUnnamedResultKeys()
    {
        $startingCriteria = new CriteriaCollection();
        $secondCriteria = new CriteriaCollection();
        $thirdCriteria = new CriteriaCollection();

        $cells = [
            new Cell(
                $this->getSearcher($startingCriteria, [1,2,3]),
                $this->getTransformer([1,2,3], $secondCriteria)
            ),
            new Cell(
                $this->getSearcher($secondCriteria, [4,5,6]),
                $this->getTransformer([4,5,6], $thirdCriteria)
            ),
            new Cell(
                $this->getSearcher($thirdCriteria, [7,8,9]),
                new EndTransformer()
            ),
        ];

        $chain = new ChainSearch($cells);
        $results = $chain->search($startingCriteria);

        $this->assertCount(count($cells), $results);
        $this->assertEquals(
            [0, 1, 2],
            array_keys($results->getResults())
        );
        $this->assertEquals([
            [1,2,3],
            [4,5,6],
            [7,8,9],
        ], $results->getResults());
    }

    /**
     * @param int $numberOfCells
     * @param $expectedException
     * @dataProvider tooLessCellsDataProvider
     */
    public function testTooLessCellValidation($numberOfCells, $expectedException)
    {
        // array_fill(0,0,[]) is not working on PHP 5.5 and 5.4
        if (0 == $numberOfCells) {
            $array = [];
        } else {
            $array = array_fill(
                0,
                $numberOfCells,
                new Cell(
                    $this->getSearcher(new CriteriaCollection()),
                    $this->getTransformer([1])
                )
            );
        }

        if ($expectedException) {
            $this->setExpectedException('\InvalidArgumentException');
        }

        new ChainSearch($array);
    }

    /**
     * @return array
     */
    public function tooLessCellsDataProvider()
    {
        return [
            [0, true],
            [1, true],
            [2, false],
            [3, false],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNotCellInterfaceValidation()
    {
        new ChainSearch([
            new Cell($this->getSearcher(new CriteriaCollection()), $this->getTransformer([])),
            new Cell($this->getSearcher(new CriteriaCollection()), $this->getTransformer([])),
            new \stdClass(),
        ]);
    }

    public function testSkippingTransformer()
    {
        $firstCriteria = new CriteriaCollection();

        $search = new ChainSearch([
            new Cell($this->getSearcher(new CriteriaCollection(), [1]), $this->getTransformer([1], $firstCriteria), 'first'),
            new Cell($this->getSearcher($firstCriteria, [2]), $this->getSkipTransformer(), 'second'),
            new Cell($this->getSearcher(new CriteriaCollection(), [3]), new EndTransformer(), 'third'),
        ]);

        $result = $search->search(new CriteriaCollection());

        $this->assertEquals([
            'first' => [1],
            'third' => [3],
        ], $result->getResults());
    }

    public function testSkippingFirstTransformer()
    {
        $firstCriteria = new CriteriaCollection();

        $search = new ChainSearch([
            new Cell($this->getSearcher($firstCriteria, [2]), $this->getSkipTransformer(), 'second'),
            new Cell($this->getSearcher(new CriteriaCollection(), [1]), $this->getTransformer([1], $firstCriteria), 'first'),
            new Cell($this->getSearcher(new CriteriaCollection(), [3]), new EndTransformer(), 'third'),
        ]);

        $result = $search->search(new CriteriaCollection());

        $this->assertEquals([
            'first' => [1],
            'third' => [3],
        ], $result->getResults());
    }

    private function getSkipTransformer()
    {
        $transformer = $this
            ->getMockBuilder('\KGzocha\Searcher\Chain\TransformerInterface')
            ->getMock();

        $transformer
            ->expects($this->once())
            ->method('skip')
            ->willReturn(true);

        $transformer
            ->expects($this->never())
            ->method('transform')
            ->withAnyParameters();

        return $transformer;
    }

    /**
     * @param mixed                            $entryData
     * @param CriteriaCollectionInterface|null $result
     *
     * @return \KGzocha\Searcher\Chain\TransformerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getTransformer(
        $entryData,
        CriteriaCollectionInterface $result = null
    ) {
        if (!$result) {
            $result = new CriteriaCollection();
        }

        $transformer = $this
            ->getMockBuilder('\KGzocha\Searcher\Chain\TransformerInterface')
            ->getMock();

        $transformer
            ->expects($this->any())
            ->method('transform')
            ->with($entryData)
            ->willReturn($result);

        return $transformer;
    }

    /**
     * @param CriteriaCollectionInterface $criteriaCollection
     * @param mixed $results
     *
     * @return \KGzocha\Searcher\SearcherInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getSearcher(
        CriteriaCollectionInterface $criteriaCollection,
        $results = null
    ) {
        $searcher = $this
            ->getMockBuilder('\KGzocha\Searcher\SearcherInterface')
            ->getMock();

        $searcher
            ->expects($this->any())
            ->method('search')
            ->with($criteriaCollection)
            ->willReturn($results);

        return $searcher;
    }
}
