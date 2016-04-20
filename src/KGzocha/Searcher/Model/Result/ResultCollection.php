<?php

namespace KGzocha\Searcher\Model\Result;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Model\Result
 */
class ResultCollection implements ResultCollectionInterface
{
    /**
     * @var array
     */
    private $results;

    /**
     * @param array $results
     */
    public function __construct(array $results = [])
    {
        $this->results = $results;
    }

    /**
     * @inheritdoc
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->results);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->results;
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->results);
    }
}
