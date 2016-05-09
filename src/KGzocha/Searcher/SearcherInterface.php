<?php
namespace KGzocha\Searcher;

use KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollectionInterface;
use KGzocha\Searcher\Result\ResultCollectionInterface;

interface SearcherInterface
{
    /**
     * @param QueryCriteriaCollectionInterface $filterCollection
     * @return ResultCollectionInterface
     */
    public function search(
        QueryCriteriaCollectionInterface $filterCollection
    );
}
