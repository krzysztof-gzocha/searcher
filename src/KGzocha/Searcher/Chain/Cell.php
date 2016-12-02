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
     * @inheritdoc
     */
    public function getSearcher(): SearcherInterface
    {
        return $this->searcher;
    }

    /**
     * @inheritdoc
     */
    public function getTransformer(): TransformerInterface
    {
        return $this->transformer;
    }

    /**
     * @inheritdoc
     */
    public function hasTransformer(): bool
    {
        return !$this->transformer instanceof EndTransformer;
    }
}
