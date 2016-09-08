<?php

namespace KGzocha\Searcher\Chain\Collection;

use KGzocha\Searcher\AbstractCollection;
use KGzocha\Searcher\Chain\CellInterface;

/**
 * Collection of CellInterface objects. It will throw \InvalidArgumentException if tried to use it with less
 * than MINIMUM_CELLS.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class CellCollection extends AbstractCollection implements CellCollectionInterface
{
    const MINIMUM_CELLS = 2;

    /**
     * @inheritDoc
     */
    protected function isItemValid($item)
    {
        return $item instanceof CellInterface;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        $this->validateNumberOfCells();

        return parent::getIterator();
    }

    /**
     * @return CellInterface[]
     */
    public function getCells()
    {
        $this->validateNumberOfCells();

        return $this->getItems();
    }

    /**
     * @param string $name
     *
     * @return CellInterface|null
     */
    public function getNamedCell($name)
    {
        return $this->getNamedItem($name);
    }

    /**
     * @param CellInterface $item
     *
     * @return $this
     */
    public function addCell(CellInterface $item)
    {
        return $this->addItem($item);
    }

    /**
     * @param string        $name
     * @param CellInterface $cell
     *
     * @return $this
     */
    public function addNamedCell($name, CellInterface $cell)
    {
        return $this->addNamedItem($name, $cell);
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validateNumberOfCells()
    {
        $count = $this->count();
        if (self::MINIMUM_CELLS <= $count) {
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'At last %d cells are required, but there are only %d in collection %s',
            self::MINIMUM_CELLS,
            $count,
            get_class($this)
        ));
    }
}
