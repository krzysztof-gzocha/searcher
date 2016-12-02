<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Criteria\Collection;

use KGzocha\Searcher\Criteria\CriteriaInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class NamedCriteriaCollection extends CriteriaCollection implements NamedCriteriaCollectionInterface
{
    /**
     * @param string $name
     *
     * @return null|CriteriaInterface
     */
    public function __get(string $name)
    {
        return $this->getNamedCriteria($name);
    }

    /**
     * @param string            $name
     * @param CriteriaInterface $value
     */
    public function __set(string $name, CriteriaInterface $value)
    {
        $this->addNamedCriteria($name, $value);
    }

    /**
     * @param string            $name
     * @param CriteriaInterface $criteria
     *
     * @return NamedCriteriaCollectionInterface
     */
    public function addNamedCriteria(string $name, CriteriaInterface $criteria): NamedCriteriaCollectionInterface
    {
        return $this->addNamedItem($name, $criteria);
    }

    /**
     * @param string $name
     *
     * @return null|CriteriaInterface
     */
    public function getNamedCriteria($name)
    {
        return $this->getNamedItem($name);
    }
}
