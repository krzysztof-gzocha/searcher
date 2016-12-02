<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Context;

use Symfony\Component\Finder\Finder;

/**
 * Use this searching context to search for files with Symfony Finder component.
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
    public function getQueryBuilder(): Finder
    {
        return parent::getQueryBuilder();
    }

    /**
     * @return \Iterator
     */
    public function getResults(): \Iterator
    {
        return $this->getQueryBuilder()->getIterator();
    }

    /**
     * @return FinderSearchingContext
     */
    public static function buildDefault(): FinderSearchingContext
    {
        return new self(new Finder());
    }
}
