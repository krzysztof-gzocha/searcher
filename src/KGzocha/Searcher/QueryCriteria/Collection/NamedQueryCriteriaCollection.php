<?php

namespace KGzocha\Searcher\QueryCriteria\Collection;

use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class NamedQueryCriteriaCollection extends QueryCriteriaCollection implements
    NamedQueryCriteriaCollectionInterface
{
    /**
     * @param string $name
     *
     * @return null|QueryCriteriaInterface
     */
    public function __get($name)
    {
        return $this->getNamedQueryCriteria($name);
    }

    /**
     * @param string                 $name
     * @param QueryCriteriaInterface $value
     */
    public function __set($name, QueryCriteriaInterface $value)
    {
        $this->addNamedQueryCriteria($name, $value);
    }

    /**
     * @param string                 $name
     * @param QueryCriteriaInterface $filterModel
     *
     * @return $this
     */
    public function addNamedQueryCriteria(
        $name,
        QueryCriteriaInterface $filterModel
    ) {
        $this->queryCriteria[$name] = $filterModel;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return null|QueryCriteriaInterface
     */
    public function getNamedQueryCriteria($name)
    {
        return array_key_exists($name, $this->queryCriteria)
            ? $this->queryCriteria[$name]
            : null;
    }
}
