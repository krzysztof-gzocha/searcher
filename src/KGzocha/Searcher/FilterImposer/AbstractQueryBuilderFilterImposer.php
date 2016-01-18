<?php

namespace KGzocha\DoctrineSearcher\FilterImposer;

use KGzocha\DoctrineSearcher\QueryBuilderSearchingContext;
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
}
