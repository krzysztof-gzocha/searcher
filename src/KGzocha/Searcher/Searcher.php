<?php

namespace KGzocha\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\Collection\CriteriaBuilderCollectionInterface;
use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;
use KGzocha\Searcher\Criteria\CriteriaInterface;

/**
 * Main class responsible for performing actual searching.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class Searcher implements SearcherInterface
{
    /**
     * @var CriteriaBuilderCollectionInterface
     */
    private $builders;

    /**
     * @var SearchingContextInterface
     */
    private $searchingContext;

    /**
     * @param CriteriaBuilderCollectionInterface $builders
     * @param SearchingContextInterface          $searchingContext
     */
    public function __construct(
        CriteriaBuilderCollectionInterface $builders,
        SearchingContextInterface $searchingContext
    ) {
        $this->builders = $builders;
        $this->searchingContext = $searchingContext;
    }

    /**
     * {@inheritdoc}
     */
    public function search(
        CriteriaCollectionInterface $criteriaCollection
    ) {
        foreach ($criteriaCollection->getCriteria() as $criteria) {
            $this->searchForModel($criteria, $this->searchingContext);
        }

        return $this->searchingContext->getResults();
    }

    /**
     * @param CriteriaInterface         $criteria
     * @param SearchingContextInterface $searchingContext
     */
    private function searchForModel(
        CriteriaInterface $criteria,
        SearchingContextInterface $searchingContext
    ) {
        $builders = $this
            ->builders
            ->getCriteriaBuildersForContext($searchingContext);

        foreach ($builders as $builder) {
            if ($builder->allowsCriteria($criteria)) {
                $builder->buildCriteria($criteria, $searchingContext);
            }
        }
    }
}
