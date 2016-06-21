<?php

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;

/**
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
