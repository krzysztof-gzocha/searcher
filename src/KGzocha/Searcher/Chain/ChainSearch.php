<?php

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\Chain\Collection\CellCollectionInterface;
use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;
use KGzocha\Searcher\Result\ResultCollection;
use KGzocha\Searcher\SearcherInterface;

/**
 * This class represents whole chain of searchers, but it behaves like regular searcher.
 * It will perform all (not skipped) sub-searches, transform theirs results into CriteriaCollection
 * and pass those criteria to next sub-search.
 * At the end it will return collection of all the results from all the steps.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ChainSearch implements SearcherInterface
{
    /**
     * @var CellCollectionInterface
     */
    private $cellCollection;

    /**
     * @param CellCollectionInterface $cellCollection
     */
    public function __construct(CellCollectionInterface $cellCollection)
    {
        $this->cellCollection = $cellCollection;
    }

    /**
     * Will perform multiple sub-searches.
     * Results from first search will be transformed and passed as CriteriaCollection
     * to another sub-search.
     * Whole process will return collection of results from each sub-search.
     *
     * @param CriteriaCollectionInterface $criteriaCollection
     *
     * @return ResultCollection
     */
    public function search(
        CriteriaCollectionInterface $criteriaCollection
    ) {
        $previousCriteria = $criteriaCollection;
        $previousResults = null;
        $result = new ResultCollection();

        /** @var CellInterface $cell */
        foreach ($this->cellCollection as $name => $cell) {
            if ($cell->getTransformer()->skip($previousResults)) {
                continue;
            }

            $previousResults = $cell->getSearcher()->search($previousCriteria);
            $previousCriteria = $this->getNewCriteria(
                $cell,
                $previousCriteria,
                $previousResults
            );

            $result->addNamedItem($name, $previousResults);
        }

        return $result;
    }

    /**
     * If $cell has transformer then it will be used to return new criteria.
     * If not old criteria will be returned.
     *
     * @param CellInterface               $cell
     * @param CriteriaCollectionInterface $criteria
     * @param mixed                       $results
     *
     * @return CriteriaCollectionInterface
     */
    private function getNewCriteria(
        CellInterface $cell,
        CriteriaCollectionInterface $criteria,
        $results
    ) {
        if (!$cell->hasTransformer()) {
            return $criteria;
        }

        return $cell
            ->getTransformer()
            ->transform($results, $criteria);
    }
}
