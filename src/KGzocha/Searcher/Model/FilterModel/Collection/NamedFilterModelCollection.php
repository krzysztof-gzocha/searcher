<?php

namespace KGzocha\Searcher\Model\FilterModel\Collection;

use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Model\FilterModel\Collection
 */
class NamedFilterModelCollection extends FilterModelCollection implements
    NamedFilterModelCollectionInterface
{
    /**
     * @param string $name
     * @return null|FilterModelInterface
     */
    public function __get($name)
    {
        return $this->getNamedFilterModel($name);
    }

    /**
     * @param string $name
     * @param FilterModelInterface $value
     */
    public function __set($name, FilterModelInterface $value)
    {
        $this->addNamedFilterModel($name, $value);
    }

    /**
     * @param string $name
     * @param FilterModelInterface $filterModel
     *
     * @return $this
     */
    public function addNamedFilterModel(
        $name,
        FilterModelInterface $filterModel
    ) {
        $this->filterModels[$name] = $filterModel;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return null|FilterModelInterface
     */
    public function getNamedFilterModel($name)
    {
        return array_key_exists($name, $this->filterModels)
            ? $this->filterModels[$name]
            : null;
    }
}
