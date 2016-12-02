<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Result;

use KGzocha\Searcher\AbstractCollection;

/**
 * Can be used to hold results from searching when developer is not 100% sure
 * if searching process will return array of objects or a number, or null, or whatever.
 * This class regardless the constructor will always be iteratable, so in worse case scenario
 * there will be no results inside, but your controllers will still work.
 * It's not recommended to use it on development environment due to eventual problems with debugging.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ResultCollection extends AbstractCollection implements ResultCollectionInterface
{
    /**
     * @inheritDoc
     */
    public function addNamedItem(string $name, $item): AbstractCollection
    {
        return parent::addNamedItem($name, $item);
    }

    /**
     * {@inheritdoc}
     */
    public function getResults()
    {
        return $this->getItems();
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->getItems();
    }

    /**
     * @inheritDoc
     */
    protected function isItemValid($item): bool
    {
        return true;
    }
}
