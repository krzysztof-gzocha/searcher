<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Context\Elastica;

use Elastica\Query;
use Elastica\Scroll;
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
    public function __construct(Search $search, Query $query = null, string $expiryTime = '1m')
    {
        parent::__construct($search, $query);
        $this->expiryTime = $expiryTime;
    }

    /**
     * @return Scroll|\Iterator
     */
    public function getResults(): \Iterator
    {
        $this
            ->getSearch()
            ->setQuery($this->getQueryBuilder());

        return $this->getSearch()->scroll($this->expiryTime);
    }
}
