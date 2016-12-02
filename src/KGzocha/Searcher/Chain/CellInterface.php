<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\SearcherInterface;

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
     * @return SearcherInterface
     */
    public function getSearcher(): SearcherInterface;

    /**
     * @return TransformerInterface
     */
    public function getTransformer(): TransformerInterface;

    /**
     * @return bool
     */
    public function hasTransformer(): bool;
}
