<?php

namespace KGzocha\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\Collection\QueryCriteriaBuilderCollectionInterface;
use KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollectionInterface;
use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * Class Searcher
 *
 * @package KGzocha\Searcher
 */
class Searcher implements SearcherInterface
{
    /**
     * @var QueryCriteriaBuilderCollectionInterface
     */
    private $queryCriteriaBuilderCollection;

    /**
     * @var SearchingContextInterface
     */
    private $searchingContext;

    /**
     * @param QueryCriteriaBuilderCollectionInterface $queryCriteriaBuilderCollection
     * @param SearchingContextInterface $searchingContext
     */
    public function __construct(
        QueryCriteriaBuilderCollectionInterface $queryCriteriaBuilderCollection,
        SearchingContextInterface $searchingContext
    ) {
        $this->queryCriteriaBuilderCollection = $queryCriteriaBuilderCollection;
        $this->searchingContext = $searchingContext;
    }

    /**
     * @inheritdoc
     */
    public function search(
        QueryCriteriaCollectionInterface $filterCollection
    ) {
        foreach ($filterCollection->getCriteria() as $filterModel) {
            $this->searchForModel($filterModel, $this->searchingContext);
        }

        return $this->searchingContext->getResults();
    }

    /**
     * @param QueryCriteriaInterface $queryCriteria
     * @param SearchingContextInterface $searchingContext
     */
    private function searchForModel(
        QueryCriteriaInterface $queryCriteria,
        SearchingContextInterface $searchingContext
    ) {
        $builders = $this
            ->queryCriteriaBuilderCollection
            ->getQueryCriteriaBuildersForContext($searchingContext);

        foreach ($builders as $builder) {
            if ($builder->allowsCriteria($queryCriteria)) {
                $builder->buildCriteria($queryCriteria, $searchingContext);
            }
        }
    }
}
