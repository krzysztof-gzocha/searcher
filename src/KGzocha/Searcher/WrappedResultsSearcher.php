<?php

namespace KGzocha\Searcher;

use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;
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
     * {@inheritdoc}
     */
    public function search(
        CriteriaCollectionInterface $criteriaCollection
    ) {
        return new ResultCollection(
            $this->searcher->search($criteriaCollection)
        );
    }
}
