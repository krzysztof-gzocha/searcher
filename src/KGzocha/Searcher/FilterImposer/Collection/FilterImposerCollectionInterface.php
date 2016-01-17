<?php
namespace KGzocha\Searcher\FilterImposer\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\FilterImposerInterface;

interface FilterImposerCollectionInterface
{
    /**
     * @param FilterImposerInterface $filterImposer
     *
     * @return FilterImposerCollectionInterface
     */
    public function addFilterImposer(FilterImposerInterface $filterImposer);

    /**
     * @return FilterImposerInterface[]
     */
    public function getFilterImposers();

    /**
     * @param SearchingContextInterface $searchingContext
     * @return FilterImposerInterface[]
     */
    public function getFilterImposersForContext(
        SearchingContextInterface $searchingContext
    );
}
