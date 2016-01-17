<?php

namespace KGzocha\Searcher\Event;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\Collection\FilterImposerCollectionInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Event
 */
abstract class AbstractEvent implements SearcherEventInterface
{
    /**
     * @var FilterImposerCollectionInterface
     */
    private $filterImposerCollection;

    /**
     * @var SearchingContextInterface
     */
    private $searchingContext;

    /**
     * @param FilterImposerCollectionInterface $filterImposerCollection
     * @param SearchingContextInterface $searchingContext
     */
    public function __construct(
        FilterImposerCollectionInterface $filterImposerCollection,
        SearchingContextInterface $searchingContext
    ) {
        $this->filterImposerCollection = $filterImposerCollection;
        $this->searchingContext = $searchingContext;
    }

    /**
     * @return FilterImposerCollectionInterface
     */
    public function getFilterImposerCollection()
    {
        return $this->filterImposerCollection;
    }

    /**
     * @return SearchingContextInterface
     */
    public function getSearchingContext()
    {
        return $this->searchingContext;
    }

    /**
     * @param FilterImposerCollectionInterface $filterImposerCollection
     */
    public function setFilterImposerCollection(
        FilterImposerCollectionInterface $filterImposerCollection
    ) {
        $this->filterImposerCollection = $filterImposerCollection;
    }

    /**
     * @param SearchingContextInterface $searchingContext
     */
    public function setSearchingContext(
        SearchingContextInterface $searchingContext
    ) {
        $this->searchingContext = $searchingContext;
    }
}
