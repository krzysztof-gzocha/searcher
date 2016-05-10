<?php

namespace KGzocha\Searcher\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * Will hold all QueryCriteria that can be used in search process.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
interface QueryCriteriaCollectionInterface
{
    /**
     * Will return array of QueryCriteriaInterface
     * that returns true in shouldBeApplied().
     *
     * @return QueryCriteriaInterface[]
     */
    public function getApplicableCriteria();

    /**
     * @return QueryCriteriaInterface[]
     */
    public function getCriteria();

    /**
     * @param QueryCriteriaInterface $queryCriteria
     *
     * @return QueryCriteriaCollectionInterface
     */
    public function addQueryCriteria(QueryCriteriaInterface $queryCriteria);
}
