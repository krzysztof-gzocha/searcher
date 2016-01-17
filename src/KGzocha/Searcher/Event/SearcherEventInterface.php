<?php

namespace KGzocha\Searcher\Event;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\Collection\FilterImposerCollectionInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Event
 */
interface SearcherEventInterface
{
    /**
     * @return SearchingContextInterface
     */
    public function getSearchingContext();

    /**
     * @return FilterImposerCollectionInterface
     */
    public function getFilterImposerCollection();
}
