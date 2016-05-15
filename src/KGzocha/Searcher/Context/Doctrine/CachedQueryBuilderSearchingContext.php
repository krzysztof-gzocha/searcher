<?php

/*
 * This file is part of the searcher package.
 *
 * (c) Daniel Ribeiro <drgomesp@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KGzocha\Searcher\Context\Doctrine;

/**
 * Class CachedQueryBuilderSearchingContext
 *
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 * @package KGzocha\Searcher\Context\Doctrine
 */
class CachedQueryBuilderSearchingContext extends QueryBuilderSearchingContext
{
    public function getResults()
    {
        return $this
            ->getQueryBuilder()
            ->getQuery()
            ->useQueryCache(true)
            ->getResult();
    }
}
