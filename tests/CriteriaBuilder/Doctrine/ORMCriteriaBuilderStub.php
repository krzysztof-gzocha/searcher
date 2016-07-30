<?php

namespace KGzocha\Searcher\Test\CriteriaBuilder\Doctrine;

use Doctrine\ORM\QueryBuilder;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\Criteria\CriteriaInterface;
use KGzocha\Searcher\CriteriaBuilder\Doctrine\AbstractORMCriteriaBuilder;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ORMCriteriaBuilderStub extends AbstractORMCriteriaBuilder
{
    /**
     * @inheritDoc
     */
    public function buildCriteria(
        CriteriaInterface $criteria,
        SearchingContextInterface $searchingContext
    ) {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function allowsCriteria(CriteriaInterface $criteria)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function join(QueryBuilder $queryBuilder, $join, $alias, $joinType)
    {
        return parent::join($queryBuilder, $join, $alias, $joinType);
    }

    /**
     * @inheritDoc
     */
    public function filterExistingJoins(
        QueryBuilder $queryBuilder,
        $joinParts,
        $alias,
        $join,
        $joinType
    ) {
        return parent::filterExistingJoins(
            $queryBuilder,
            $joinParts,
            $alias,
            $join,
            $joinType
        );
    }
}
