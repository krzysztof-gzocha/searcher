<?php
namespace KGzocha\Searcher\Chain\Collection;

use KGzocha\Searcher\Chain\CellInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface CellCollectionInterface extends \Countable, \IteratorAggregate
{
    /**
     * @return CellInterface[]
     */
    public function getCells();

    /**
     * @param string $name
     *
     * @return CellInterface|null
     */
    public function getNamedCell(string $name);

    /**
     * @param CellInterface $item
     *
     * @return CellCollectionInterface
     */
    public function addCell(CellInterface $item): CellCollectionInterface;

    /**
     * @param string        $name
     * @param CellInterface $cell
     *
     * @return CellCollectionInterface
     */
    public function addNamedCell(string $name, CellInterface $cell): CellCollectionInterface;
}
