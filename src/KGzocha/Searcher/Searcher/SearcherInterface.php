<?php
namespace KGzocha\Searcher\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\Model\FilterModel\Collection\FilterModelCollectionInterface;

interface SearcherInterface
{
    /**
     * @param FilterModelCollectionInterface $filterCollection
     * @param SearchingContextInterface $searchingContext
     */
    public function search(
        FilterModelCollectionInterface $filterCollection,
        SearchingContextInterface $searchingContext
    );
}
