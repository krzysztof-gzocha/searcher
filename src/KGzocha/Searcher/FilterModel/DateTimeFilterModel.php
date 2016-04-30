<?php

namespace KGzocha\Searcher\FilterModel;

/**
 * Class DateTimeFilterModel
 * @package KGzocha\Searcher\FilterModel
 */
class DateTimeFilterModel implements FilterModelInterface
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
     * @return DateTimeFilterModel
     */
    public function setDateTime(\DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isImposed()
    {
        return $this->dateTime instanceof \DateTime;
    }
}
