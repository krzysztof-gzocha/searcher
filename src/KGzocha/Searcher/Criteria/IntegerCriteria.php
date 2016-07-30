<?php

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class IntegerCriteria implements CriteriaInterface
{
    /**
     * @var int
     */
    private $integer;

    /**
     * @param int $integer
     */
    public function __construct($integer = null)
    {
        $this->integer = $integer;
    }

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
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->integer !== null;
    }
}
