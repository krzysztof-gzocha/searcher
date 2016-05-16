<?php

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class NumberCriteria implements CriteriaInterface
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
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->number !== null
            && is_float($this->number);
    }
}
