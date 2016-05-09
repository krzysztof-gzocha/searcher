<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface OrderByQueryCriteriaInterface extends QueryCriteriaInterface
{
    /**
     * @return null|string
     */
    public function getOrderBy();

    /**
     * @param null|string $orderBy
     */
    public function setOrderBy($orderBy);
}
