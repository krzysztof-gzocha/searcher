<?php

namespace KGzocha\Searcher\FilterImposer\Doctrine;

use KGzocha\Searcher\Context\Doctrine\ODMBuilderSearchingContext;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface;

/**
 * Abstract QueryCriteriaBuilder that can be used in builders that supports
 * only ODMBuilderSearchingContext.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
abstract class AbstractODMQueryCriteriaBuilder implements
    QueryCriteriaBuilderInterface
{
    /**
     * @param SearchingContextInterface $searchingContext
     *
     * @return bool
     */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    ) {
        return $searchingContext instanceof ODMBuilderSearchingContext;
    }
}
