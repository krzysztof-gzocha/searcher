<?php

namespace KGzocha\Searcher\FilterImposer;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;

interface FilterImposerInterface
{
    /**
     * Will impose conditions with values taken from FilterModel.
     * @param FilterModelInterface      $filterModel
     * @param SearchingContextInterface $searchingContext
     */
    public function imposeFilter(
        FilterModelInterface $filterModel,
        SearchingContextInterface $searchingContext
    );

    /**
     * Will return true if this FilterImposer supports specific FilterModel.
     *
     * @param FilterModelInterface $filterModel
     *
     * @return bool
     */
    public function supportsModel(
        FilterModelInterface $filterModel
    );

    /**
     * @param SearchingContextInterface $searchingContext
     *
     * @return mixed
     */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    );
}
