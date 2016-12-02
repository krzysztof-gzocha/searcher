<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class IntegerRangeCriteria implements CriteriaInterface
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
     * @param int|null $min
     * @param int|null $max
     */
    public function __construct(int $min = null, int $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return int|null
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin(int $min = null)
    {
        $this->min = $min;
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
    public function setMax(int $max = null)
    {
        $this->max = $max;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->min !== null && $this->max !== null;
    }
}
