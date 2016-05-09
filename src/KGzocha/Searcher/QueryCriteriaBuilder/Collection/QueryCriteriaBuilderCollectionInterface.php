<?php
namespace KGzocha\Searcher\QueryCriteriaBuilder\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface;

/**
 * Interface QueryCriteriaBuilderCollectionInterface
 *
 * @package KGzocha\Searcher\FilterImposer\Collection
 */
interface QueryCriteriaBuilderCollectionInterface
{
    /**
     * @param QueryCriteriaBuilderInterface $filterImposer
     *
     * @return QueryCriteriaBuilderCollectionInterface
     */
    public function addQueryCriteriaBuilder(QueryCriteriaBuilderInterface $filterImposer);

    /**
     * @return QueryCriteriaBuilderInterface[]
     */
    public function getQueryCriteriaBuilders();

    /**
     * @param SearchingContextInterface $searchingContext
     * @return QueryCriteriaBuilderInterface[]
     */
    public function getQueryCriteriaBuildersForContext(
        SearchingContextInterface $searchingContext
    );
}
