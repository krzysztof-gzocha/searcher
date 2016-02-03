<?php

namespace KGzocha\Searcher\Model\FilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Model\FilterModel
 */
class IntegerRangeFilterModel implements FilterModelInterface
{
    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin($min)
    {
        $this->min = (int) $min;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $max
     */
    public function setMax($max)
    {
        $this->max = (int) $max;
    }

    /**
     * @inheritDoc
     */
    public function isImposed()
    {
        return $this->min !== null && $this->max !== null;
    }
}
