<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Criteria;

/**
 * Class DateTimeFilterModel.
 */
class DateTimeCriteria implements CriteriaInterface
{
    /**
     * @var \DateTime
     */
    private $dateTime;

    /**
     * @param \DateTime $dateTime
     */
    public function __construct(\DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return null|\DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime|null $dateTime
     */
    public function setDateTime(\DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->dateTime instanceof \DateTime;
    }
}
