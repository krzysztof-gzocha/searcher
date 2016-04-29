<?php

namespace KGzocha\Searcher\Model\FilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class OrderByFilterModel implements OrderByFilterModelInterface
{
    /**
     * @var null|string
     */
    private $orderBy;

    /**
     * @param null|string $orderBy
     */
    public function __construct($orderBy = null)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return null|string
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param null|string $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @inheritDoc
     */
    public function isImposed()
    {
        return $this->orderBy != null;
    }
}
