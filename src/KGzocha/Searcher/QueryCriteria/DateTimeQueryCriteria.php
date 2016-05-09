<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * Class DateTimeFilterModel
 * @package KGzocha\Searcher\FilterModel
 */
class DateTimeQueryCriteria implements QueryCriteriaInterface
{
    /**
     * @var \DateTime
     */
    private $dateTime;

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
     * @return DateTimeQueryCriteria
     */
    public function setDateTime(\DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function shouldBeApplied()
    {
        return $this->dateTime instanceof \DateTime;
    }
}
