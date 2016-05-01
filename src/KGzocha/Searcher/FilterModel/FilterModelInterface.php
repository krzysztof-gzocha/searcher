<?php

namespace KGzocha\Searcher\FilterModel;

/**
 * Interface FilterModelInterface
 * @package KGzocha\Searcher\FilterModel
 */
interface FilterModelInterface
{
    /**
     * Returns true if this FilterModel should be taken
     * into consideration when build query.
     * @return bool
     */
    public function isImposed();
}
