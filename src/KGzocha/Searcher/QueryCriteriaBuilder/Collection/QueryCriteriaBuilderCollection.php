<?php

namespace KGzocha\Searcher\QueryCriteriaBuilder\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface;

class QueryCriteriaBuilderCollection implements QueryCriteriaBuilderCollectionInterface
{
    /**
     * @var QueryCriteriaBuilderInterface[]
     */
    private $queryCriteriaBuilders;

    /**
     * @param QueryCriteriaBuilderInterface[] $builders
     */
    public function __construct(array $builders = [])
    {
        $this->queryCriteriaBuilders = [];
        foreach ($builders as $builder) {
            // In this way we will ensure that
            // every element in array has correct type
            $this->addQueryCriteriaBuilder($builder);
        }
    }

    /**
     * @inheritDoc
     */
    public function addQueryCriteriaBuilder(QueryCriteriaBuilderInterface $filterImposer)
    {
        $this->queryCriteriaBuilders[] = $filterImposer;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getQueryCriteriaBuilders()
    {
        return $this->queryCriteriaBuilders;
    }

    /**
     * @inheritdoc
     */
    public function getQueryCriteriaBuildersForContext(
        SearchingContextInterface $searchingContext
    ) {
        return array_filter(
            $this->getQueryCriteriaBuilders(),
            function(QueryCriteriaBuilderInterface $queryCriteriaBuilder) use ($searchingContext) {
                return $queryCriteriaBuilder->supportsSearchingContext($searchingContext);
            }
        );
    }
}
