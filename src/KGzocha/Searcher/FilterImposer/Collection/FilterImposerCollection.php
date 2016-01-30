<?php

namespace KGzocha\Searcher\FilterImposer\Collection;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\FilterImposerInterface;

class FilterImposerCollection implements FilterImposerCollectionInterface
{
    /**
     * @var FilterImposerInterface[]
     */
    private $filterImposers;

    /**
     * @param FilterImposerInterface[] $filterImposers
     */
    public function __construct(array $filterImposers = [])
    {
        $this->filterImposers = [];
        foreach ($filterImposers as $filterImposer) {
            // In this way we will ensure that
            // every element in array has correct type
            $this->addFilterImposer($filterImposer);
        }
    }

    /**
     * @inheritDoc
     */
    public function addFilterImposer(FilterImposerInterface $filterImposer)
    {
        $this->filterImposers[] = $filterImposer;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFilterImposers()
    {
        return $this->filterImposers;
    }

    /**
     * @inheritdoc
     */
    public function getFilterImposersForContext(
        SearchingContextInterface $searchingContext
    ) {
        return array_filter(
            $this->getFilterImposers(),
            function (FilterImposerInterface $imposer) use ($searchingContext) {
                return $imposer->supportsSearchingContext($searchingContext);
            }
        );
    }
}
