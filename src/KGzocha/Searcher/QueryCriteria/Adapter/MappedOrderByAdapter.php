<?php

namespace KGzocha\Searcher\QueryCriteria\Adapter;

use KGzocha\Searcher\QueryCriteria\OrderByQueryCriteriaInterface;

/**
 * This adapter can be used if end-user should not see the actual parameter values
 * that are used in sorting. In order to do so, please provide parameter $fieldsMap.
 * Fields map key should be a value that will be visible to end-user.
 * Fields map value will be visible to developer.
 * To get "mapped" value (for end-user) just use getOrderBy()
 * To get "real" value (for developer) use getMappedOrderBy().
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class MappedOrderByAdapter implements OrderByQueryCriteriaInterface
{
    /**
     * @var OrderByQueryCriteriaInterface
     */
    private $orderBy;

    /**
     * @var array|\ArrayAccess
     */
    private $fieldsMap;

    /**
     * @param OrderByQueryCriteriaInterface $orderBy
     * @param array|\ArrayAccess            $fieldsMap keys will be visible to user,
     *                                                 values to QueryCriteriaBuilder
     */
    public function __construct(
        OrderByQueryCriteriaInterface $orderBy,
        $fieldsMap
    ) {
        $this->checkFieldsMapType($fieldsMap);
        $this->orderBy = $orderBy;
        $this->fieldsMap = $fieldsMap;
    }

    /**
     * @return string|null Returns null if user will enter value that is not in fieldsMap
     */
    public function getMappedOrderBy()
    {
        if ($this->rawValueExistsInFieldsMap()) {
            return $this->fieldsMap[$this->getOrderBy()];
        }

        return;
    }

    /**
     * @return array|\ArrayAccess
     */
    public function getFieldsMap()
    {
        return $this->fieldsMap;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderBy()
    {
        return $this->orderBy->getOrderBy();
    }

    /**
     * {@inheritdoc}
     */
    public function setOrderBy($orderBy)
    {
        return $this->orderBy->setOrderBy($orderBy);
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->orderBy->shouldBeApplied() && $this->rawValueExistsInFieldsMap();
    }

    /**
     * @param mixed $fieldsMap
     *
     * @throws \InvalidArgumentException
     */
    private function checkFieldsMapType($fieldsMap)
    {
        if (!is_array($fieldsMap) && !$fieldsMap instanceof \ArrayAccess) {
            throw new \InvalidArgumentException(sprintf(
                'Parameter fieldsMap passed to %s should be an array or \ArrayAccess.'
                .' Given: %s',
                __CLASS__,
                is_object($fieldsMap) ? get_class($fieldsMap) : gettype($fieldsMap)
            ));
        }
    }

    /**
     * @return bool
     */
    private function rawValueExistsInFieldsMap()
    {
        return array_key_exists($this->getOrderBy(), $this->fieldsMap);
    }
}
