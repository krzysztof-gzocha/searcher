<?php

namespace KGzocha\Searcher\FilterImposer;
use KGzocha\Searcher\Context\ODMBuilderSearchingContext;
use KGzocha\Searcher\Context\SearchingContextInterface;

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
