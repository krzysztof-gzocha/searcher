<?php

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;

/**
 * Only responsibility of services implementing this interface is to transform results from previous
 * search to CriteriaCollectionInterface that can be used in next search.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface TransformerInterface
{
    /**
     * @param mixed $results
     *
     * @return CriteriaCollectionInterface
     */
    public function transform($results);

    /**
     * @param mixed $results
     *
     * @return bool
     */
    public function skip($results);
}
