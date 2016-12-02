<?php
declare(strict_types=1);

namespace KGzocha\Searcher\CriteriaBuilder\Doctrine;

use KGzocha\Searcher\Context\Doctrine\ODMBuilderSearchingContext;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface;

/**
 * Abstract CriteriaBuilder that can be used in builders that supports
 * only ODMBuilderSearchingContext.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
abstract class AbstractODMCriteriaBuilder implements CriteriaBuilderInterface
{
    /**
     * @param SearchingContextInterface $searchingContext
     *
     * @return bool
     */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    ): bool {
        return $searchingContext instanceof ODMBuilderSearchingContext;
    }
}
