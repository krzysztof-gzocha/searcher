<?php

namespace KGzocha\Searcher\Result;

/**
 * Can be used to hold results from searching when developer is not 100% sure
 * if searching process will return array of objects or a number, or null, or whatever.
 * This class regardless the constructor will always be iteratable, so in worse case scenario
 * there will be no results inside, but your controllers will still work.
 * It's not recommended to use it on development environment due to eventual problems with debugging.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
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
