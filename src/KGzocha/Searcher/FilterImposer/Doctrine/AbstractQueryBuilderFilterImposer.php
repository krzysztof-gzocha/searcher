<?php

namespace KGzocha\Searcher\FilterImposer\Doctrine;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\FilterImposer\FilterImposerInterface;

/**
 * Filter imposers that requires {@link QueryBuilderSearchingContext}
 * in SearchingContext can extend this class.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\DoctrineSearcher\FilterImposer
 */
abstract class AbstractQueryBuilderFilterImposer implements
    FilterImposerInterface
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
     *
     * @param QueryBuilder $queryBuilder
     * @param string $join
     * @param string $alias
     *
     * @return QueryBuilder
     */
    protected function join(QueryBuilder $queryBuilder, $join, $alias)
    {
        list($entity) = explode('.', $join);

        $joinParts = $queryBuilder->getDQLPart('join');
        if (!array_key_exists($entity, $joinParts)) {
            return $queryBuilder->join($join, $alias);
        }

        $joinParts = $joinParts[$entity];
        $existingJoin = array_filter(
            $joinParts,
            function(Join $joinObj) use ($alias, $join) {
                return $joinObj->getAlias() == $alias
                && $joinObj->getJoin() == $join;
            }
        );

        if ([] != $existingJoin) {
            return $queryBuilder;
        }

        return $queryBuilder->join($join, $alias);
    }
}
