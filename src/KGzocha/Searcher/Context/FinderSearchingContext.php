<?php

namespace KGzocha\Searcher\Context;

use Symfony\Component\Finder\Finder;

/**
 * Use this searching context to search for files with Symfony Finder component
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class FinderSearchingContext extends AbstractSearchingContext
{
    /**
     * @param $finder Finder
     */
    public function __construct(Finder $finder)
    {
        parent::__construct($finder);
    }

    /**
     * @return Finder
     */
    public function getQueryBuilder()
    {
        return parent::getQueryBuilder();
    }

    /**
     * @return \Iterator
     */
    public function getResults()
    {
        return $this->getQueryBuilder()->getIterator();
    }

    /**
     * @return FinderSearchingContext
     */
    public static function buildDefault()
    {
        return new FinderSearchingContext(new Finder());
    }
}
