<?php
declare(strict_types=1);

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
    protected function isItemValid($item): bool
    {
        return $item instanceof CellInterface;
    }

    /**
     * @inheritdoc
     */
    public function getIterator(): \Iterator
    {
        $this->validateNumberOfCells();

        return parent::getIterator();
    }

    /**
     * @inheritdoc
     */
    public function getCells()
    {
        $this->validateNumberOfCells();

        return $this->getItems();
    }

    /**
     * @inheritdoc
     */
    public function getNamedCell(string $name)
    {
        return $this->getNamedItem($name);
    }

    /**
     * @inheritdoc
     */
    public function addCell(CellInterface $item): CellCollectionInterface
    {
        return $this->addItem($item);
    }

    /**
     * @inheritdoc
     */
    public function addNamedCell(string $name, CellInterface $cell): CellCollectionInterface
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
