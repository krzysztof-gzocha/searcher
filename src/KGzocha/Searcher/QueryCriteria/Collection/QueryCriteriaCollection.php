<?php

namespace KGzocha\Searcher\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * Class QueryCriteriaCollection
 *
 * @author Daniel Ribeiro <daniel.ribeiro@propertyfinder.ae>
 * @package KGzocha\Searcher\QueryCriteria\Collection
 */
class QueryCriteriaCollection implements QueryCriteriaCollectionInterface
{
    /**
     * @var QueryCriteriaInterface[]
     */
    protected $queryCriteria;

    /**
     * @param QueryCriteriaInterface[] $providedCriteria
     */
    public function __construct(array $providedCriteria = [])
    {
        $this->queryCriteria = [];

        foreach ($providedCriteria as $criteria) {
            // In this way we will ensure that
            // every element in array has correct type
            $this->addQueryCriteria($criteria);
        }
    }

    /**
     * @inheritdoc
     */
    public function getApplicableCriteria()
    {
        return array_filter(
            $this->getCriteria(),
            function(QueryCriteriaInterface $queryCriteria) {
                return $queryCriteria->shouldBeApplied();
            }
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getCriteria()
    {
        return $this->queryCriteria;
    }

    /**
     * {@inheritDoc}
     */
    public function addQueryCriteria(QueryCriteriaInterface $queryCriteria)
    {
        $this->queryCriteria[] = $queryCriteria;

        return $this;
    }
}
