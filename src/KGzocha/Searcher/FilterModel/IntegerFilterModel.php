<?php

namespace KGzocha\Searcher\FilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\FilterModel
 */
class IntegerFilterModel implements FilterModelInterface
{
    /**
     * @var int
     */
    private $integer;

    /**
     * @return int
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * @param int $integer
     */
    public function setInteger($integer)
    {
        $this->integer = (int) $integer;
    }

    /**
     * @inheritDoc
     */
    public function isImposed()
    {
        return $this->integer !== null;
    }
}
