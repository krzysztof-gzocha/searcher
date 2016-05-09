<?php

namespace KGzocha\Searcher\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * Interface FilterModelCollectionInterface
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 *
 * @package KGzocha\Searcher\FilterModelCollection
 */
interface QueryCriteriaCollectionInterface
{
    /**
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
