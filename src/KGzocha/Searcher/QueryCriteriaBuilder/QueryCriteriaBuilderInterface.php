<?php

namespace KGzocha\Searcher\QueryCriteriaBuilder;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * Defines a query criteria builder.
 *
 * Essentially, a builder makes use of multiple criteria to build query
 * partials based on the provided searching context.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
interface QueryCriteriaBuilderInterface
{
    /**
     * Will impose conditions with values taken from the criteria.
     *
     * @param QueryCriteriaInterface    $criteria
     * @param SearchingContextInterface $searchingContext
     */
    public function buildCriteria(
        QueryCriteriaInterface $criteria,
        SearchingContextInterface $searchingContext
    );

    /**
     * Checks if the builder supports the provided criteria.
     *
     * @param QueryCriteriaInterface $criteria
     *
     * @return bool
     */
    public function allowsCriteria(QueryCriteriaInterface $criteria);

    /**
     * @param SearchingContextInterface $searchingContext
     *
     * @return mixed
     */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    );
}
