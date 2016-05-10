<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class IntegerRangeQueryCriteria implements QueryCriteriaInterface
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
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->min !== null && $this->max !== null;
    }
}
