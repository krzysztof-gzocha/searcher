<?php

namespace KGzocha\Searcher\Model\FilterModel;

/**
 * Class DateTimeRangeFilterModel
 * @package KGzocha\Searcher\Model\FilterModel
 */
class DateTimeRangeFilterModel implements FilterModelInterface
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
     * @return DateTimeRangeFilterModel
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
     * @return DateTimeRangeFilterModel
     */
    public function setEndingDateTime(
        \DateTime $endingDateTime = null
    ) {
        $this->endingDateTime = $endingDateTime;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isImposed()
    {
        return $this->startingDateTime instanceof \DateTime
            || $this->endingDateTime instanceof \DateTime;
    }
}
