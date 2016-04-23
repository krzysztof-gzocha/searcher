<?php

namespace KGzocha\Searcher\Model\Result;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Model\Result
 */
interface ResultCollectionInterface extends \Countable, \IteratorAggregate, \JsonSerializable
{
    /**
     * @return array
     */
    public function getResults();
}
