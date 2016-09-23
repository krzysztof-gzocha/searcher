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
     * {@inheritdoc}
     */
    public function buildCriteria(
        CriteriaInterface $criteria,
        SearchingContextInterface $searchingContext
    ) {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function allowsCriteria(CriteriaInterface $criteria)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function join(QueryBuilder $queryBuilder, $join, $alias, $joinType)
    {
        return parent::join($queryBuilder, $join, $alias, $joinType);
    }

    /**
     * {@inheritdoc}
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
