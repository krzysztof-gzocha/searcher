<?php
declare(strict_types=1);

namespace KGzocha\Searcher;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\Collection\CriteriaBuilderCollectionInterface;
use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;
use KGzocha\Searcher\Criteria\CriteriaInterface;
use KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface;

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
        $builders = $this
            ->builders
            ->getCriteriaBuildersForContext($this->searchingContext);

        foreach ($criteriaCollection->getApplicableCriteria() as $criteria) {
            $this->searchForModel($criteria, $this->searchingContext, $builders);
        }

        return $this->searchingContext->getResults();
    }

    /**
     * @param CriteriaInterface                  $criteria
     * @param SearchingContextInterface          $searchingContext
     * @param CriteriaBuilderCollectionInterface $builders
     */
    private function searchForModel(
        CriteriaInterface $criteria,
        SearchingContextInterface $searchingContext,
        CriteriaBuilderCollectionInterface $builders
    ) {
        /** @var CriteriaBuilderInterface $builder */
        foreach ($builders as $builder) {
            if ($builder->allowsCriteria($criteria)) {
                $builder->buildCriteria($criteria, $searchingContext);
            }
        }
    }
}
