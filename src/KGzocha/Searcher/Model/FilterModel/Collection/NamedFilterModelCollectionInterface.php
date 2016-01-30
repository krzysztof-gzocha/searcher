<?php

namespace KGzocha\Searcher\Model\FilterModel\Collection;

use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Model\FilterModel\Collection
 */
interface NamedFilterModelCollectionInterface extends
    FilterModelCollectionInterface
{
    /**
     * @param string $name
     * @param FilterModelInterface $filterModel
     *
     * @return $this
     */
    public function addNamedFilterModel(
        $name,
        FilterModelInterface $filterModel
    );

    /**
     * @param string $name
     *
     * @return null|FilterModelInterface
     */
    public function getNamedFilterModel($name);
}
