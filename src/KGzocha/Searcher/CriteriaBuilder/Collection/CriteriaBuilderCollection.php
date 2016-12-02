<?php
declare(strict_types=1);

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
    public function addCriteriaBuilder(CriteriaBuilderInterface $criteriaBuilder): CriteriaBuilderCollectionInterface
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
    ): CriteriaBuilderCollectionInterface {
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
    protected function isItemValid($item): bool
    {
        return $item instanceof CriteriaBuilderInterface;
    }
}
