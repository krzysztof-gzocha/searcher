<?php
declare(strict_types=1);

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
    public function __construct(int $integer = null)
    {
        $this->integer = $integer;
    }

    /**
     * @return int|null
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * @param int $integer
     */
    public function setInteger(int $integer = null)
    {
        $this->integer = $integer;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->integer !== null;
    }
}
