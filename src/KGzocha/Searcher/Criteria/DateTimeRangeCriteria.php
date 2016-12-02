<?php
declare(strict_types=1);

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
     * @return \DateTime|null
     */
    public function getStartingDateTime()
    {
        return $this->startingDateTime;
    }

    /**
     * @param \DateTime|null $startingDateTime
     */
    public function setStartingDateTime(
        \DateTime $startingDateTime = null
    ) {
        $this->startingDateTime = $startingDateTime;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndingDateTime()
    {
        return $this->endingDateTime;
    }

    /**
     * @param \DateTime|null $endingDateTime
     */
    public function setEndingDateTime(
        \DateTime $endingDateTime = null
    ) {
        $this->endingDateTime = $endingDateTime;
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->startingDateTime instanceof \DateTime
            || $this->endingDateTime instanceof \DateTime;
    }
}
