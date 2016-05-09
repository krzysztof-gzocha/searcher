<?php

namespace KGzocha\Searcher\QueryCriteriaBuilder\Doctrine;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\QueryCriteriaBuilder\QueryCriteriaBuilderInterface;

/**
 * Abstract QueryCriteriaBuilder that can be used in builders that supports
 * only ODMBuilderSearchingContext.
 * Extra feature is join() method which will add another join only
 * if there is not such join already
 *
*@author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
abstract class AbstractORMQueryCriteriaBuilder implements
    QueryCriteriaBuilderInterface
{
    /**
     * @inheritDoc
     */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    ) {
        return $searchingContext instanceof QueryBuilderSearchingContext;
    }

    /**
     * Will do JOIN only if there is no such join already.
     * For any other more advanced join strategies please use unique aliases.
     * Remember: for performance reasons you should keep number of joins as low as possible
     * Example usage: $this->join($qb, 'p.house', 'h', Join::LEFT_JOIN)
     *
     * @param QueryBuilder $queryBuilder
     * @param string $join
     * @param string $alias
     * @param string $joinType
     *
     * @return QueryBuilder
     */
    protected function join(QueryBuilder $queryBuilder, $join, $alias, $joinType)
    {
        list($entity) = explode('.', $join);

        $joinParts = $queryBuilder->getDQLPart('join');
        if (!array_key_exists($entity, $joinParts)) {
            return $queryBuilder->join($join, $alias);
        }

        return $this->filterExistingJoins(
            $queryBuilder,
            $joinParts[$entity],
            $alias,
            $join,
            $joinType
        );
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param array        $joinParts
     * @param string       $alias
     * @param string       $join
     * @param string       $joinType
     *
     * @return QueryBuilder|static
     */
    protected function filterExistingJoins(
        QueryBuilder $queryBuilder,
        $joinParts,
        $alias,
        $join,
        $joinType
    ) {
        $existingJoin = array_filter(
            $joinParts,
            function(Join $joinObj) use ($alias, $join, $joinType) {
                return $joinObj->getJoinType() == $joinType
                    && $joinObj->getAlias() == $alias
                    && $joinObj->getJoin() == $join;
            }
        );

        if ([] != $existingJoin) {
            return $queryBuilder;
        }

        return $queryBuilder->join($join, $alias);
    }
}
