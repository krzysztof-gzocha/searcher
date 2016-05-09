<?php

namespace KGzocha\Searcher\FilterImposer\Doctrine;

use KGzocha\Searcher\Context\Doctrine\ODMBuilderSearchingContext;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface;

/**
 * Class AbstractODMBuilderQueryCriteriaBuilder
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 *
 * @package KGzocha\Searcher\FilterImposer\Doctrine
 */
abstract class AbstractODMBuilderQueryCriteriaBuilder implements
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
