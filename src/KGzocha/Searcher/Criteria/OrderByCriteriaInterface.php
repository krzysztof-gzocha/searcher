<?php

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface OrderByCriteriaInterface extends CriteriaInterface
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
