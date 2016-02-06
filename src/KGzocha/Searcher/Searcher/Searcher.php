<?php

namespace KGzocha\Searcher\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\Collection\FilterImposerCollectionInterface;
use KGzocha\Searcher\Model\FilterModel\Collection\FilterModelCollectionInterface;
use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;

class Searcher implements SearcherInterface
{
    /**
     * @var FilterImposerCollectionInterface
     */
    private $imposerCollection;

    /**
     * @param FilterImposerCollectionInterface $imposerCollection
     */
    public function __construct(
        FilterImposerCollectionInterface $imposerCollection
    ) {
        $this->imposerCollection = $imposerCollection;
    }

    /**
     * @inheritdoc
     */
    public function search(
        FilterModelCollectionInterface $filterCollection,
        SearchingContextInterface $searchingContext
    ) {
        foreach ($filterCollection->getImposedModels() as $filterModel) {
            $this->searchForModel($filterModel, $searchingContext);
        }

        return $searchingContext->getResults();
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
