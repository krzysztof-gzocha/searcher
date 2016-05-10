<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * Class DateTimeFilterModel.
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
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->dateTime instanceof \DateTime;
    }
}
