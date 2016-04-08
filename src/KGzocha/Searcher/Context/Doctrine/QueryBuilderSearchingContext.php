<?php

namespace KGzocha\Searcher\Context\Doctrine;

use Doctrine\ORM\QueryBuilder;
use KGzocha\Searcher\Context\AbstractSearchingContext;

/**
 * Use this class as a SearchingContext in order to allow all filter imposers
 * to work with Doctrine's QueryBuilder.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\DoctrineSearcher\ORM
 */
class QueryBuilderSearchingContext extends AbstractSearchingContext
{
    /**
     * @inheritDoc
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        parent::__construct($queryBuilder);
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return parent::getQueryBuilder();
    }

    /**
     * @inheritdoc
     */
    public function getResults()
    {
        return $this->getQueryBuilder()->getQuery()->getResult();
    }
}
