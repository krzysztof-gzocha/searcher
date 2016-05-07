<?php

namespace KGzocha\Searcher\Result;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Result
 */
class ResultCollection implements ResultCollectionInterface
{
    /**
     * @var array
     */
    private $results;

    /**
     * @param \Traversable|array $results
     */
    public function __construct($results = [])
    {
        if ($this->canUseResults($results)) {
            $this->results = $results;

            return;
        }

        $this->results = [];
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

    /**
     * @param \Traversable|array $results
     * @return bool
     */
    private function canUseResults($results = [])
    {
        return is_array($results) || $results instanceof \Traversable;
    }
}
