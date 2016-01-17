<?php

namespace KGzocha\Searcher\Context;

/**
 * This class should be extended and make sure that QueryBuilder's type
 * is correct for all required FilterImposers. This is a layer of abstraction
 * between searcher and searching engines and ORMs.
 *
 * @author Krzysztof Gzocha
 * @package KGzocha\Searcher\Context
 */
abstract class AbstractSearchingContext implements SearchingContextInterface
{
    /**
     * @var mixed query builder or any other service required by filter imposers.
     */
    private $queryBuilder;

    /**
     * This method should be overwritten in extending SearchingContext's in
     * order to provide strict type for QueryBuilder.
     *
     * @param mixed $queryBuilder will be used in filter imposers to impose
     * all the conditions.
     */
    public function __construct($queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @inheritdoc
     */
    abstract public function getResults();

    /**
     * @return mixed
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
}
