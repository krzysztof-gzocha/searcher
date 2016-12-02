<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class OrderByCriteria implements OrderByCriteriaInterface
{
    /**
     * @var null|string
     */
    private $orderBy;

    /**
     * @param null|string $orderBy
     */
    public function __construct(string $orderBy = null)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return null|string
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param null|string $orderBy
     */
    public function setOrderBy(string $orderBy = null)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->orderBy !== null && !empty($this->orderBy);
    }
}
