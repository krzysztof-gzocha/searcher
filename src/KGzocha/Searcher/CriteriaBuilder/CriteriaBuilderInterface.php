<?php

namespace KGzocha\Searcher\CriteriaBuilder;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\Criteria\CriteriaInterface;

/**
 * Defines a query criteria builder.
 *
 * Essentially, a builder makes use of multiple criteria to build query
 * partials based on the provided searching context.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
interface CriteriaBuilderInterface
{
    /**
     * Will impose conditions with values taken from the criteria.
     *
     * @param CriteriaInterface         $criteria
     * @param SearchingContextInterface $searchingContext
     */
    public function buildCriteria(
        CriteriaInterface $criteria,
        SearchingContextInterface $searchingContext
    );

    /**
     * Checks if the builder supports the provided criteria.
     *
     * @param CriteriaInterface $criteria
     *
     * @return bool
     */
    public function allowsCriteria(CriteriaInterface $criteria);

    /**
     * @param SearchingContextInterface $searchingContext
     *
     * @return bool
     */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    );
}
