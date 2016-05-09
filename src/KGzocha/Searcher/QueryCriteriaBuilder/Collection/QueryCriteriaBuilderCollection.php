<?php

namespace KGzocha\Searcher\QueryCriteriaBuilder\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class QueryCriteriaBuilderCollection implements QueryCriteriaBuilderCollectionInterface
{
    /**
     * @var QueryCriteriaBuilderInterface[]
     */
    private $queryCriteriaBuilders;

    /**
     * @param QueryCriteriaBuilderInterface[] $builders array or \Traversable object
     */
    public function __construct($builders = [])
    {
        $this->queryCriteriaBuilders = [];
        $this->checkType($builders);
        foreach ($builders as $builder) {
            // In this way we will ensure that
            // every element in array has correct type
            $this->addQueryCriteriaBuilder($builder);
        }
    }

    /**
     * @inheritDoc
     */
    public function addQueryCriteriaBuilder(QueryCriteriaBuilderInterface $queryCriteriaBuilder)
    {
        $this->queryCriteriaBuilders[] = $queryCriteriaBuilder;

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

    /**
     * Will ensure that provided criteria are array or traversable object
     *
     * @param mixed $criteriaBuilders
     */
    private function checkType($criteriaBuilders)
    {
        if (is_array($criteriaBuilders)
            || $criteriaBuilders instanceof \Traversable) {
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'Provided criteria builders should be an array or \Traversable object. Given: %s',
            is_object($criteriaBuilders) ? get_class($criteriaBuilders) : gettype($criteriaBuilders)
        ));
    }
}
