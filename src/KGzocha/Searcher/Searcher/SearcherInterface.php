<?php
namespace KGzocha\Searcher\Searcher;

use KGzocha\Searcher\Model\FilterModel\Collection\FilterModelCollectionInterface;
use KGzocha\Searcher\Model\Result\ResultCollectionInterface;

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
