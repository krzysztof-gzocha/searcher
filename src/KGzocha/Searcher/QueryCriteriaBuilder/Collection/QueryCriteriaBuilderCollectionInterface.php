<?php

namespace KGzocha\Searcher\QueryCriteriaBuilder\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface;

/**
 * Will hold collection of all QueryCriteriaBuilders that can be used
 * during single searching process.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface QueryCriteriaBuilderCollectionInterface
{
    /**
     * @param QueryCriteriaBuilderInterface $queryCriteriaBuilder
     *
     * @return QueryCriteriaBuilderCollectionInterface
     */
    public function addQueryCriteriaBuilder(
        QueryCriteriaBuilderInterface $queryCriteriaBuilder
    );

    /**
     * @return QueryCriteriaBuilderInterface[]
     */
    public function getQueryCriteriaBuilders();

    /**
     * @param SearchingContextInterface $searchingContext
     * 
     * @return QueryCriteriaBuilderInterface[]
     */
    public function getQueryCriteriaBuildersForContext(
        SearchingContextInterface $searchingContext
    );
}
