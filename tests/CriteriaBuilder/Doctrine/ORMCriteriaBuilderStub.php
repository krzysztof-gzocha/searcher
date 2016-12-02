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
    public function allowsCriteria(CriteriaInterface $criteria): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function join(QueryBuilder $queryBuilder, string $join, string $alias, string $joinType): QueryBuilder
    {
        return parent::join($queryBuilder, $join, $alias, $joinType);
    }

    /**
     * {@inheritdoc}
     */
    public function filterExistingJoins(
        QueryBuilder $queryBuilder,
        array $joinParts,
        string $alias,
        string $join,
        string $joinType
    ): QueryBuilder
    {
        return parent::filterExistingJoins(
            $queryBuilder,
            $joinParts,
            $alias,
            $join,
            $joinType
        );
    }
}
