<?php

namespace KGzocha\Searcher\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * Acts like regular QueryCriteriaCollection, but has possibility to specify key under which
 * given QueryCriteria will be stored. Use it when you want to ensure unique models or to ease hydration.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
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
