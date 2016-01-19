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
     * @param \DateTime $startingDateTime
     *
     * @return DateTimeRangeFilterModel
     */
    public function setStartingDateTime(\DateTime $startingDateTime)
    {
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
     * @param \DateTime $endingDateTime
     *
     * @return DateTimeRangeFilterModel
     */
    public function setEndingDateTime(\DateTime $endingDateTime)
    {
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
