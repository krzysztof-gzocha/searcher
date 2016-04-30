<?php

namespace KGzocha\Searcher\FilterModel\Collection;

use KGzocha\Searcher\FilterModel\FilterModelInterface;

class FilterModelCollection implements FilterModelCollectionInterface
{
    /**
     * @var FilterModelInterface[]
     */
    protected $filterModels;

    /**
     * @param FilterModelInterface[] $filterModels
     */
    public function __construct(array $filterModels = [])
    {
        $this->filterModels = [];
        foreach ($filterModels as $filterModel) {
            // In this way we will ensure that
            // every element in array has correct type
            $this->addFilterModel($filterModel);
        }
    }

    /**
     * @inheritdoc
     */
    public function getImposedModels()
    {
        return array_filter(
            $this->getFilterModels(),
            function(FilterModelInterface $filterModel) {
                return $filterModel->isImposed();
            }
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getFilterModels()
    {
        return $this->filterModels;
    }

    /**
     * {@inheritDoc}
     */
    public function addFilterModel(FilterModelInterface $filterModel)
    {
        $this->filterModels[] = $filterModel;

        return $this;
    }
}
