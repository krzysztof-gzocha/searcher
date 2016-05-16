<?php

namespace KGzocha\Searcher\Criteria;

/**
 * Class DateTimeRangeFilterModel.
 */
class DateTimeRangeCriteria implements CriteriaInterface
{
    /**
     * @var \DateTime
     */
    private $startingDateTime;

    /**
     * @var \DateTime
     */
    private $endingDateTime;

    /**
     * @return \DateTime
     */
    public function getStartingDateTime()
    {
        return $this->startingDateTime;
    }

    /**
     * @param \DateTime|null $startingDateTime
     *
     * @return DateTimeRangeCriteria
     */
    public function setStartingDateTime(
        \DateTime $startingDateTime = null
    ) {
        $this->startingDateTime = $startingDateTime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndingDateTime()
    {
        return $this->endingDateTime;
    }

    /**
     * @param \DateTime|null $endingDateTime
     *
     * @return DateTimeRangeCriteria
     */
    public function setEndingDateTime(
        \DateTime $endingDateTime = null
    ) {
        $this->endingDateTime = $endingDateTime;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->startingDateTime instanceof \DateTime
            || $this->endingDateTime instanceof \DateTime;
    }
}
