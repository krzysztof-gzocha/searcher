<?php

namespace KGzocha\Searcher;

use KGzocha\Searcher\FilterModel\Collection\FilterModelCollectionInterface;
use KGzocha\Searcher\Result\ResultCollection;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class WrappedResultsSearcher implements SearcherInterface
{
    /**
     * @var SearcherInterface
     */
    private $searcher;

    /**
     * @param SearcherInterface $searcher
     */
    public function __construct(SearcherInterface $searcher)
    {
        $this->searcher = $searcher;
    }

    /**
     * @inheritDoc
     */
    public function search(
        FilterModelCollectionInterface $filterCollection
    ) {
        return new ResultCollection(
            $this->searcher->search($filterCollection)
        );
    }
}
