<?php

namespace KGzocha\Searcher\Test\Chain\Collection;

use KGzocha\Searcher\Chain\CellInterface;
use KGzocha\Searcher\Chain\Collection\CellCollection;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class CellCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param CellInterface[] $cells
     * @dataProvider properGetCellsProvider
     */
    public function testProperGetCells($cells)
    {
        $collection = new CellCollection($cells);

        $this->assertEquals($cells, $collection->getCells());
    }

    /**
     * @return array
     */
    public function properGetCellsProvider()
    {
        return [
            [array_fill(0, 5, $this->getCell())],
            [array_fill(0, 10, $this->getCell())],
            [array_fill(0, 50, $this->getCell())],
            [[
                'first' => $this->getCell(),
                'second' => $this->getCell(),
            ]]
        ];
    }

    public function testNamedCellGetter()
    {
        $cellsArray = [
            'firstName' => $this->getCell(),
            'secondName' => $this->getCell(),
        ];

        $collection = new CellCollection($cellsArray);

        $collection->addNamedCell('thirdName', $this->getCell());

        $this->assertNotEmpty($collection->getNamedCell('firstName'));
        $this->assertNotEmpty($collection->getNamedCell('secondName'));
        $this->assertNotEmpty($collection->getNamedCell('thirdName'));
    }

    public function testAddCells()
    {
        $collection = new CellCollection();
        $collection->addCell($this->getCell());
        $collection->addCell($this->getCell());
        $collection->addCell($this->getCell());
        $collection->addNamedCell('name', $this->getCell());

        $this->assertCount(4, $collection);
        $this->assertEquals(4, $collection->count());
    }

    /**
     * @return CellInterface
     */
    private function getCell()
    {
        return $this->getMock('KGzocha\Searcher\Chain\CellInterface');
    }
}
