<?php

namespace KGzocha\Searcher\Criteria\Collection;

use KGzocha\Searcher\Criteria\CriteriaInterface;

/**
 * Acts like regular CriteriaCollection, but has possibility to specify key under which
 * given Criteria will be stored. Use it when you want to ensure unique models or to ease hydration.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
interface NamedCriteriaCollectionInterface extends
    CriteriaCollectionInterface
{
    /**
     * @param string                 $name
     * @param CriteriaInterface $filterModel
     *
     * @return $this
     */
    public function addNamedCriteria(
        $name,
        CriteriaInterface $filterModel
    );

    /**
     * @param string $name
     *
     * @return null|CriteriaInterface
     */
    public function getNamedCriteria($name);
}
