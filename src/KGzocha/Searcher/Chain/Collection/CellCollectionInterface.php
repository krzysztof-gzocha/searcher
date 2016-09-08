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
    public function getNamedCell($name);

    /**
     * @param CellInterface $item
     *
     * @return $this
     */
    public function addCell(CellInterface $item);

    /**
     * @param string        $name
     * @param CellInterface $cell
     *
     * @return $this
     */
    public function addNamedCell($name, CellInterface $cell);
}
