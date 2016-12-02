<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Result;

/**
 * Will holds collection of results taken from searching process.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface ResultCollectionInterface extends \Countable, \IteratorAggregate, \JsonSerializable
{
    /**
     * @return \Traversable|array
     */
    public function getResults();
}
