<?php

namespace KGzocha\Searcher\Event;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Event
 */
class ResultsEvent extends AbstractEvent
{
    /**
     * @var mixed
     */
    private $results;

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $results
     */
    public function setResults($results)
    {
        $this->results = $results;
    }
}
