<?php

namespace KGzocha\Searcher\FilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\FilterModel
 */
class NumberFilterModel implements FilterModelInterface
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
    public function isImposed()
    {
        return $this->number !== null
            && is_float($this->number);
    }
}
