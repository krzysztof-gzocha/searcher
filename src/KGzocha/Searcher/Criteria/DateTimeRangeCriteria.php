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
     * @param \DateTime $startingDateTime
     * @param \DateTime $endingDateTime
     */
    public function __construct(
        \DateTime $startingDateTime = null,
        \DateTime $endingDateTime = null
    ) {
        $this->startingDateTime = $startingDateTime;
        $this->endingDateTime = $endingDateTime;
    }

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
