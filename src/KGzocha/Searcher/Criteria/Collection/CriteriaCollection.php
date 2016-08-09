<?php

namespace KGzocha\Searcher\Criteria\Collection;

use KGzocha\Searcher\Criteria\CriteriaInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <daniel.ribeiro@propertyfinder.ae>
 */
class CriteriaCollection implements CriteriaCollectionInterface
{
    /**
     * @var CriteriaInterface[]
     */
    protected $criteria;

    /**
     * @param CriteriaInterface[] $providedCriteria array or \Traversable object
     */
    public function __construct($providedCriteria = [])
    {
        $this->criteria = [];
        $this->checkType($providedCriteria);
        foreach ($providedCriteria as $criteria) {
            // In this way we will ensure that
            // every element in array has correct type
            $this->addCriteria($criteria);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getApplicableCriteria()
    {
        return new self(array_filter(
            $this->getCriteria(),
            function(CriteriaInterface $criteria) {
                return $criteria->shouldBeApplied();
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * {@inheritdoc}
     */
    public function addCriteria(CriteriaInterface $criteria)
    {
        $this->criteria[] = $criteria;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->criteria);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->criteria);
    }

    /**
     * Will ensure that provided criteria are array or traversable object.
     *
     * @param mixed $criteria
     */
    private function checkType($criteria)
    {
        if (is_array($criteria)
            || $criteria instanceof \Traversable) {
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'Provided criteria should be an array or \Traversable object. Given: %s',
            is_object($criteria) ? get_class($criteria) : gettype($criteria)
        ));
    }
}
