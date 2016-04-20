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
     * @param \Traversable|array $results
     */
    public function __construct($results = [])
    {
        $this->checkResults($results);
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

    /**
     * @param \Traversable|array $results
     * @throws \InvalidArgumentException
     */
    private function checkResults($results = [])
    {
        if (!is_array($results) && !$results instanceof \Traversable) {
            throw new \InvalidArgumentException(sprintf(
                'Argument passed to %s should be array of Traversable object',
                __CLASS__
            ));
        }
    }
}
