<?php

namespace KGzocha\Searcher\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <daniel.ribeiro@propertyfinder.ae>
 */
class QueryCriteriaCollection implements QueryCriteriaCollectionInterface
{
    /**
     * @var QueryCriteriaInterface[]
     */
    protected $queryCriteria;

    /**
     * @param QueryCriteriaInterface[] $providedCriteria array or \Traversable object
     */
    public function __construct($providedCriteria = [])
    {
        $this->queryCriteria = [];
        $this->checkType($providedCriteria);
        foreach ($providedCriteria as $criteria) {
            // In this way we will ensure that
            // every element in array has correct type
            $this->addQueryCriteria($criteria);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getApplicableCriteria()
    {
        return array_filter(
            $this->getCriteria(),
            function (QueryCriteriaInterface $queryCriteria) {
                return $queryCriteria->shouldBeApplied();
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getCriteria()
    {
        return $this->queryCriteria;
    }

    /**
     * {@inheritdoc}
     */
    public function addQueryCriteria(QueryCriteriaInterface $queryCriteria)
    {
        $this->queryCriteria[] = $queryCriteria;

        return $this;
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
