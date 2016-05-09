<?php
namespace KGzocha\Searcher;

use KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollectionInterface;

/**
 * Will perform actual searching basing on passed QueryCriteriaCollection.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface SearcherInterface
{
    /**
     * @param QueryCriteriaCollectionInterface $queryCriteriaCollection
     *
     * @return mixed depending on SearchingContextInterface
     */
    public function search(
        QueryCriteriaCollectionInterface $queryCriteriaCollection
    );
}
