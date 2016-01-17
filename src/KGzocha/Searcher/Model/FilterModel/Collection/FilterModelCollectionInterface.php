<?php

namespace KGzocha\Searcher\Model\FilterModel\Collection;

use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;

/**
 * Interface FilterModelCollectionInterface
 * @package KGzocha\Searcher\Model\FilterModelCollection
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
