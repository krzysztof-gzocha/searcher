<?php

namespace KGzocha\Searcher\Chain;

/**
 * It represents single cell in the chain. It holds sub-searcher and it's transformer, which will
 * transform results from it's sub-searcher to CriteriaCollection that can be used in next sub-search.
 * Name of the cell will be used as the key of end result collection to allow finding all the results.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface CellInterface
{
    /**
     * @return \KGzocha\Searcher\SearcherInterface
     */
    public function getSearcher();

    /**
     * @return TransformerInterface
     */
    public function getTransformer();

    /**
     * @return bool
     */
    public function hasTransformer();
}
