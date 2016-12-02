<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;

/**
 * Only responsibility of services implementing this interface is to transform results and(/or) criteria from previous
 * search to CriteriaCollectionInterface that can be used in next search.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface TransformerInterface
{
    /**
     * Will transform previous results and criteria into new one,
     * that will be used in next cell.
     *
     * @param mixed                       $results
     * @param CriteriaCollectionInterface $criteria
     *
     * @return CriteriaCollectionInterface
     */
    public function transform($results, CriteriaCollectionInterface $criteria): CriteriaCollectionInterface;

    /**
     * Important! Results might be null when cell will be used as first one.
     *
     * @param mixed $results
     *
     * @return bool
     */
    public function skip($results): bool;
}
