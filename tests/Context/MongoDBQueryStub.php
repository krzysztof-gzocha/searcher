<?php

namespace KGzocha\Searcher\Test\Context;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class MongoDBQueryStub
{
    /**
     * @var mixed
     */
    private $results;

    /**
     * @param $results
     */
    public function __construct($results = null)
    {
        $this->results = $results;
    }

    public function execute()
    {
        return $this->results;
    }
}
