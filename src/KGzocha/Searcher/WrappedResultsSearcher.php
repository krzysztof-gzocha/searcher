<?php

namespace KGzocha\Searcher;

use KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollectionInterface;
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
        QueryCriteriaCollectionInterface $filterCollection
    ) {
        return new ResultCollection(
            $this->searcher->search($filterCollection)
        );
    }
}
