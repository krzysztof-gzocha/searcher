<?php

namespace KGzocha\Searcher\CriteriaBuilder\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface;

/**
 * Will hold collection of all CriteriaBuilders that can be used
 * during single searching process.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface CriteriaBuilderCollectionInterface extends \Countable, \IteratorAggregate
{
    /**
     * @param CriteriaBuilderInterface $criteriaBuilder
     *
     * @return CriteriaBuilderCollectionInterface
     */
    public function addCriteriaBuilder(
        CriteriaBuilderInterface $criteriaBuilder
    );

    /**
     * @return CriteriaBuilderInterface[]
     */
    public function getCriteriaBuilders();

    /**
     * @param SearchingContextInterface $searchingContext
     *
     * @return CriteriaBuilderCollectionInterface
     */
    public function getCriteriaBuildersForContext(
        SearchingContextInterface $searchingContext
    );
}
