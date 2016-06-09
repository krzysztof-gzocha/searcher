<?php

namespace KGzocha\Searcher\CriteriaBuilder\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class CriteriaBuilderCollection implements CriteriaBuilderCollectionInterface
{
    /**
     * @var CriteriaBuilderInterface[]
     */
    private $criteriaBuilders;

    /**
     * @param CriteriaBuilderInterface[] $builders array or \Traversable object
     */
    public function __construct($builders = [])
    {
        $this->criteriaBuilders = [];
        $this->checkType($builders);
        foreach ($builders as $builder) {
            // In this way we will ensure that
            // every element in array has correct type
            $this->addCriteriaBuilder($builder);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addCriteriaBuilder(CriteriaBuilderInterface $criteriaBuilder)
    {
        $this->criteriaBuilders[] = $criteriaBuilder;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCriteriaBuilders()
    {
        return $this->criteriaBuilders;
    }

    /**
     * {@inheritdoc}
     */
    public function getCriteriaBuildersForContext(
        SearchingContextInterface $searchingContext
    ) {
        return array_filter(
            $this->getCriteriaBuilders(),
            function(CriteriaBuilderInterface $criteriaBuilder) use ($searchingContext) {
                return $criteriaBuilder->supportsSearchingContext($searchingContext);
            }
        );
    }

    /**
     * Will ensure that provided criteria are array or traversable object.
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
