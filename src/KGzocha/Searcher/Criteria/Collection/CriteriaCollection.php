<?php

namespace KGzocha\Searcher\Criteria\Collection;

use KGzocha\Searcher\AbstractCollection;
use KGzocha\Searcher\Criteria\CriteriaInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <daniel.ribeiro@propertyfinder.ae>
 */
class CriteriaCollection extends AbstractCollection implements CriteriaCollectionInterface
{
    /**
     * @param CriteriaInterface[] $criteria array or \Traversable object
     */
    public function __construct($criteria = [])
    {
        parent::__construct($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function getApplicableCriteria()
    {
        return new self(array_filter(
            $this->getItems(),
            function (CriteriaInterface $criteria) {
                return $criteria->shouldBeApplied();
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getCriteria()
    {
        return $this->getItems();
    }

    /**
     * {@inheritdoc}
     */
    public function addCriteria(CriteriaInterface $criteria)
    {
        return $this->addItem($criteria);
    }

    /**
     * {@inheritdoc}
     */
    protected function isItemValid($item)
    {
        return $item instanceof CriteriaInterface;
    }
}
