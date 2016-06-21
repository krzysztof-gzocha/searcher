<?php

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\SearcherInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class Cell
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
     * @var string|null
     */
    private $name;

    /**
     * @param SearcherInterface    $searcher
     * @param TransformerInterface $transformer
     * @param string               $name
     */
    public function __construct(
        SearcherInterface $searcher,
        TransformerInterface $transformer,
        $name = null
    ) {
        $this->searcher = $searcher;
        $this->transformer = $transformer;
        $this->name = $name;
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
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function hasTransformer()
    {
        return !$this->transformer instanceof EmptyTransformer;
    }
}
