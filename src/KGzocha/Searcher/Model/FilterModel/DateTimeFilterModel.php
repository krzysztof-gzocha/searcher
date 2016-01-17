<?php

namespace KGzocha\Searcher\Model\FilterModel;

/**
 * Class DateTimeFilterModel
 * @package KGzocha\Searcher\Model\FilterModel
 */
class DateTimeFilterModel implements FilterModelInterface
{
    /**
     * @var \DateTimeInterface
     */
    private $dateTime;

    /**
     * @return \DateTimeInterface
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTimeInterface $dateTime
     *
     * @return DateTimeFilterModel
     */
    public function setDateTime(\DateTimeInterface $dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isImposed()
    {
        return $this->dateTime instanceof \DateTimeInterface;
    }
}
