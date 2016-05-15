<?php

namespace KGzocha\Searcher\Context\Doctrine;

/**
 * Use this class as a SearchingContext in order to allow all filter imposers
 * to work with Doctrine's QueryBuilder, with query caching enabled by default.
 *
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
class CachedQueryBuilderSearchingContext extends QueryBuilderSearchingContext
{
    /**
     * {@inheritdoc}
     */
    public function getResults()
    {
        return parent::getQueryBuilder()
            ->getQuery()
            ->useQueryCache(true)
            ->getResult();
    }
}
