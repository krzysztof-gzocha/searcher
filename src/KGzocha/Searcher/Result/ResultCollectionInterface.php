<?php

namespace KGzocha\Searcher\Result;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Result
 */
interface ResultCollectionInterface extends \Countable, \IteratorAggregate, \JsonSerializable
{
    /**
     * @return array
     */
    public function getResults();
}
