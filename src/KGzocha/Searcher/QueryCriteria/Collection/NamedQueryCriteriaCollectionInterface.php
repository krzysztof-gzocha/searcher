<?php

namespace KGzocha\Searcher\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 * 
 * @package KGzocha\Searcher\FilterModel\Collection
 */
interface NamedQueryCriteriaCollectionInterface extends
    QueryCriteriaCollectionInterface
{
    /**
     * @param string $name
     * @param QueryCriteriaInterface $filterModel
     *
     * @return $this
     */
    public function addNamedQueryCriteria(
        $name,
        QueryCriteriaInterface $filterModel
    );

    /**
     * @param string $name
     *
     * @return null|QueryCriteriaInterface
     */
    public function getNamedQueryCriteria($name);
}
