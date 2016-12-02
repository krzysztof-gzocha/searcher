<?php
declare(strict_types=1);

namespace KGzocha\Searcher\CriteriaBuilder\Elastica;

use KGzocha\Searcher\Context\Elastica\QuerySearchingContext;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface;

/**
 * Extends this class in your CriteriaBuilder in order to use them
 * only for Elastica\QuerySearchingContext.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
abstract class AbstractQueryCriteriaBuilder implements CriteriaBuilderInterface
{
    /**
     * {@inheritdoc}
     */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    ): bool {
        return $searchingContext instanceof QuerySearchingContext;
    }
}
