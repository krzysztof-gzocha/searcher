<?php

namespace KGzocha\Searcher\FilterImposer\Doctrine;

use KGzocha\Searcher\Context\Doctrine\ODMBuilderSearchingContext;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\FilterImposerInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\FilterImposer
 */
abstract class AbstractODMBuilderFilterImposer implements
    FilterImposerInterface
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
