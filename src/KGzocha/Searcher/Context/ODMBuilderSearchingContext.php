<?php

namespace KGzocha\Searcher\Context;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Context
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
    public function getQueryBuilder()
    {
        return parent::getQueryBuilder();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function getResults()
    {
        return $this->getQueryBuilder()->getQuery()->execute();
    }
}
