<?php

namespace KGzocha\Searcher\Context\Elastica;

use Elastica\Query;
use Elastica\Search;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ScrollingSearchingContext extends QuerySearchingContext
{
    /**
     * @var string
     */
    private $expiryTime;

    /**
     * @inheritDoc
     */
    public function __construct(Search $search, Query $query = null, $expiryTime = '1m')
    {
        parent::__construct($search, $query);
        $this->expiryTime = $expiryTime;
    }

    /**
     * @return \Elastica\Scroll
     */
    public function getResults()
    {
        $this
            ->getSearch()
            ->setQuery($this->getQueryBuilder());

        return $this->getSearch()->scroll($this->expiryTime);
    }
}
