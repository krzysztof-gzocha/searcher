<?php

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
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime|null $dateTime
     *
     * @return DateTimeCriteria
     */
    public function setDateTime(\DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->dateTime instanceof \DateTime;
    }
}
