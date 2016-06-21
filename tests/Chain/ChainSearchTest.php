<?php

namespace KGzocha\Searcher\Test\Chain;

use KGzocha\Searcher\Chain\Cell;
use KGzocha\Searcher\Chain\ChainSearch;
use KGzocha\Searcher\Chain\EmptyTransformer;
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
                new EmptyTransformer(),
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
