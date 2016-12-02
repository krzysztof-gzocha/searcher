<?php
declare(strict_types=1);

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
     * @param float $number
     */
    public function __construct(float $number = null)
    {
        $this->number = $number;
    }

    /**
     * @return float|null
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param float $number
     */
    public function setNumber(float $number = null)
    {
        $this->number = $number;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->number !== null;
    }
}
