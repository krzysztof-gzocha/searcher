<?php

namespace KGzocha\Searcher\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\Collection\FilterImposerCollectionInterface;
use KGzocha\Searcher\Model\FilterModel\Collection\FilterModelCollectionInterface;
use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;
use KGzocha\Searcher\Model\Result\ResultCollection;

class Searcher implements SearcherInterface
{
    /**
     * @var FilterImposerCollectionInterface
     */
    private $imposerCollection;

    /**
     * @var SearchingContextInterface
     */
    private $searchingContext;

    /**
     * @param FilterImposerCollectionInterface $imposerCollection
     * @param SearchingContextInterface $searchingContext
     */
    public function __construct(
        FilterImposerCollectionInterface $imposerCollection,
        SearchingContextInterface $searchingContext
    ) {
        $this->imposerCollection = $imposerCollection;
        $this->searchingContext = $searchingContext;
    }

    /**
     * @inheritdoc
     */
    public function search(
        FilterModelCollectionInterface $filterCollection
    ) {
        foreach ($filterCollection->getImposedModels() as $filterModel) {
            $this->searchForModel($filterModel, $this->searchingContext);
        }

        return new ResultCollection($this->searchingContext->getResults());
    }

    /**
     * @param FilterModelInterface $filterModel
     * @param SearchingContextInterface $searchingContext
     */
    private function searchForModel(
        FilterModelInterface $filterModel,
        SearchingContextInterface $searchingContext
    ) {
        $imposers = $this
            ->imposerCollection
            ->getFilterImposersForContext($searchingContext);

        foreach ($imposers as $imposer) {
            if ($imposer->supportsModel($filterModel)) {
                $imposer->imposeFilter($filterModel, $searchingContext);
            }
        }
    }
}
