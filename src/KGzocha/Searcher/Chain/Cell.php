<?php

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\SearcherInterface;

/**
 * It represents single cell in the chain. It holds sub-searcher and it's transformer, which will
 * transform results from it's sub-searcher to CriteriaCollection that can be used in next sub-search.
 * Name of the cell will be used as the key of end result collection to allow finding all the results.
 * 
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class Cell implements CellInterface
{
    /**
     * @var SearcherInterface
     */
    private $searcher;

    /**
     * @var TransformerInterface
     */
    private $transformer;

    /**
     * @param SearcherInterface    $searcher
     * @param TransformerInterface $transformer
     */
    public function __construct(
        SearcherInterface $searcher,
        TransformerInterface $transformer
    ) {
        $this->searcher = $searcher;
        $this->transformer = $transformer;
    }

    /**
     * @return \KGzocha\Searcher\SearcherInterface
     */
    public function getSearcher()
    {
        return $this->searcher;
    }

    /**
     * @return TransformerInterface
     */
    public function getTransformer()
    {
        return $this->transformer;
    }

    /**
     * @return bool
     */
    public function hasTransformer()
    {
        return !$this->transformer instanceof EndTransformer;
    }
}
