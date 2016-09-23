<?php

namespace KGzocha\Searcher\CriteriaBuilder\Collection;

use KGzocha\Searcher\AbstractCollection;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class CriteriaBuilderCollection extends AbstractCollection implements CriteriaBuilderCollectionInterface
{
    /**
     * @param CriteriaBuilderInterface[] $builders array or \Traversable object
     */
    public function __construct($builders = [])
    {
        parent::__construct($builders);
    }

    /**
     * {@inheritdoc}
     */
    public function addCriteriaBuilder(CriteriaBuilderInterface $criteriaBuilder)
    {
        return $this->addItem($criteriaBuilder);
    }

    /**
     * {@inheritdoc}
     */
    public function getCriteriaBuilders()
    {
        return $this->getItems();
    }

    /**
     * {@inheritdoc}
     */
    public function getCriteriaBuildersForContext(
        SearchingContextInterface $searchingContext
    ) {
        return new self(array_filter(
            $this->getItems(),
            function (CriteriaBuilderInterface $criteriaBuilder) use ($searchingContext) {
                return $criteriaBuilder->supportsSearchingContext($searchingContext);
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function isItemValid($item)
    {
        return $item instanceof CriteriaBuilderInterface;
    }
}
