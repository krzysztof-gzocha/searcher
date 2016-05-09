<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\FilterModel
 */
class IntegerQueryCriteria implements QueryCriteriaInterface
{
    /**
     * @var int
     */
    private $integer;

    /**
     * @return int
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * @param int $integer
     */
    public function setInteger($integer)
    {
        $this->integer = (int) $integer;
    }

    /**
     * @inheritDoc
     */
    public function shouldBeApplied()
    {
        return $this->integer !== null;
    }
}
