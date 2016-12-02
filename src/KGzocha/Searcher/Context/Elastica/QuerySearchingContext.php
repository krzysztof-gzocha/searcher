<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Context\Elastica;

use Elastica\Query;
use Elastica\ResultSet;
use Elastica\Search;
use KGzocha\Searcher\Context\AbstractSearchingContext;

/**
 * Use this SearchingContext to search for results using Elastica library.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class QuerySearchingContext extends AbstractSearchingContext
{
    /**
     * @var Search
     */
    private $search;

    /**
     * @param Query  $query
     * @param Search $search
     */
    public function __construct(
        Search $search,
        Query $query = null
    ) {
        $this->search = $search;

        if (!$query) {
            $query = new Query();
        }
        parent::__construct($query);
    }

    /**
     * @return Query
     */
    public function getQueryBuilder(): Query
    {
        return parent::getQueryBuilder();
    }

    /**
     * @return Search
     */
    public function getSearch(): Search
    {
        return $this->search;
    }

    /**
     * @return ResultSet|\Iterator
     */
    public function getResults(): \Iterator
    {
        $this->getSearch()->setQuery($this->getQueryBuilder());

        return $this->getSearch()->search();
    }
}
