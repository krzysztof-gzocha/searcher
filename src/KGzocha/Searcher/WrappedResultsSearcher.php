<?php

namespace KGzocha\Searcher;

use KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollectionInterface;
use KGzocha\Searcher\Result\ResultCollection;

/**
 * Will pass all results from search to ResultCollection.
 * Not recommended to use in development environment due to eventual problems with debugging.
 * Should be used only if results are supposed to return array or traversable object.
 *
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
        QueryCriteriaCollectionInterface $queryCriteriaCollection
    ) {
        return new ResultCollection(
            $this->searcher->search($queryCriteriaCollection)
        );
    }
}
