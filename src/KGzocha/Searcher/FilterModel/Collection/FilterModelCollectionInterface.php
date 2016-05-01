<?php

namespace KGzocha\Searcher\FilterModel\Collection;

use KGzocha\Searcher\FilterModel\FilterModelInterface;

/**
 * Interface FilterModelCollectionInterface
 * @package KGzocha\Searcher\FilterModelCollection
 */
interface FilterModelCollectionInterface
{
    /**
     * @return FilterModelInterface[]
     */
    public function getImposedModels();

    /**
     * @return FilterModelInterface[]
     */
    public function getFilterModels();

    /**
     * @param FilterModelInterface $filterModel
     *
     * @return FilterModelCollectionInterface
     */
    public function addFilterModel(FilterModelInterface $filterModel);
}
