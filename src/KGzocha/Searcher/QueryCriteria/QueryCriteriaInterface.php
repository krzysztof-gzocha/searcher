<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * Interface FilterModelInterface
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 *
 * @package KGzocha\Searcher\FilterModel
 */
interface QueryCriteriaInterface
{
    /**
     * Checks if the query criteria should be applied when building the query.
     *
     * @return bool
     */
    public function shouldBeApplied();
}
