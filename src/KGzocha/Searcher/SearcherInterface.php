<?php
namespace KGzocha\Searcher;

use KGzocha\Searcher\FilterModel\Collection\FilterModelCollectionInterface;
use KGzocha\Searcher\Result\ResultCollectionInterface;

interface SearcherInterface
{
    /**
     * @param FilterModelCollectionInterface $filterCollection
     * @return ResultCollectionInterface
     */
    public function search(
        FilterModelCollectionInterface $filterCollection
    );
}
