<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Context\Doctrine;

use Doctrine\ODM\MongoDB\Query\Builder;
use KGzocha\Searcher\Context\AbstractSearchingContext;

/**
 * Use this searching context to search through records using Doctrine's ODM.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ODMBuilderSearchingContext extends AbstractSearchingContext
{
    /**
     * @param Builder $queryBuilder
     */
    public function __construct(Builder $queryBuilder)
    {
        parent::__construct($queryBuilder);
    }

    /**
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return parent::getQueryBuilder();
    }

    /**
     * If you want to be sure that Searcher will return results as an array or \Traversable
     * you can use already implemented WrappedResultsSearcher as an adapter.
     *
     * @return mixed
     *
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function getResults()
    {
        return $this->getQueryBuilder()->getQuery()->execute();
    }
}
