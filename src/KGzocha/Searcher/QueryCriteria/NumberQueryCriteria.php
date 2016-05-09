<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\FilterModel
 */
class NumberQueryCriteria implements QueryCriteriaInterface
{
    /**
     * @var float
     */
    private $number;

    /**
     * @return float
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param float $number
     */
    public function setNumber($number)
    {
        $this->number = (float) $number;
    }

    /**
     * @inheritDoc
     */
    public function shouldBeApplied()
    {
        return $this->number !== null
            && is_float($this->number);
    }
}
