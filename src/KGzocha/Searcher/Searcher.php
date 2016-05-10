<?php

namespace KGzocha\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\Collection\QueryCriteriaBuilderCollectionInterface;
use KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollectionInterface;
use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * Main class responsible for performing actual searching.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class Searcher implements SearcherInterface
{
    /**
     * @var QueryCriteriaBuilderCollectionInterface
     */
    private $builders;

    /**
     * @var SearchingContextInterface
     */
    private $searchingContext;

    /**
     * @param QueryCriteriaBuilderCollectionInterface $builders
     * @param SearchingContextInterface               $searchingContext
     */
    public function __construct(
        QueryCriteriaBuilderCollectionInterface $builders,
        SearchingContextInterface $searchingContext
    ) {
        $this->builders = $builders;
        $this->searchingContext = $searchingContext;
    }

    /**
     * {@inheritdoc}
     */
    public function search(
        QueryCriteriaCollectionInterface $queryCriteriaCollection
    ) {
        foreach ($queryCriteriaCollection->getCriteria() as $criteria) {
            $this->searchForModel($criteria, $this->searchingContext);
        }

        return $this->searchingContext->getResults();
    }

    /**
     * @param QueryCriteriaInterface    $queryCriteria
     * @param SearchingContextInterface $searchingContext
     */
    private function searchForModel(
        QueryCriteriaInterface $queryCriteria,
        SearchingContextInterface $searchingContext
    ) {
        $builders = $this
            ->builders
            ->getQueryCriteriaBuildersForContext($searchingContext);

        foreach ($builders as $builder) {
            if ($builder->allowsCriteria($queryCriteria)) {
                $builder->buildCriteria($queryCriteria, $searchingContext);
            }
        }
    }
}
