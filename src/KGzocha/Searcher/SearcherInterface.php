<?php
declare(strict_types=1);

namespace KGzocha\Searcher;

use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;

/**
 * Will perform actual searching basing on passed CriteriaCollection.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface SearcherInterface
{
    /**
     * @param CriteriaCollectionInterface $criteriaCollection
     *
     * @return mixed depending on SearchingContextInterface
     */
    public function search(
        CriteriaCollectionInterface $criteriaCollection
    );
}
