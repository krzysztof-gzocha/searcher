<?php

/*
 * This file is part of the searcher package.
 *
 * (c) Daniel Ribeiro <drgomesp@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KGzocha\Searcher\Test\Context;

/**
 * Stub for making sure that useQueryCache will be called.
 *
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
class QueryStub
{
    private $results;

    /**
     * @param $results
     */
    public function __construct($results = null)
    {
        $this->results = $results;
    }

    /**
     * @see \Doctrine\ORM\Query::useQueryCache()
     */
    public function useQueryCache($bool) {}

    /**
     * @see \Doctrine\ORM\Query::getResult()
     */
    public function getResult()
    {
        return $this->results;
    }
}
