<?php

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;
use KGzocha\Searcher\Result\ResultCollection;
use KGzocha\Searcher\SearcherInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ChainSearch implements SearcherInterface
{
    /**
     * @var Cell[]
     */
    private $cells;

    /**
     * @param Cell[] $cells
     */
    public function __construct(array $cells)
    {
        $this->validateCells($cells);
        $this->cells = $cells;
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
        $previousCriteria = null;
        $previousResults = null;
        $resultsArray = [];

        foreach ($this->cells as $cell) {
            if ($this->shouldSkipResults($cell->getTransformer(), $previousResults)) {
                continue;
            }

            // Assumed only for first iteration
            if (!$previousCriteria) {
                $previousCriteria = $criteriaCollection;
            }

            $previousResults = $cell->getSearcher()->search($previousCriteria);
            if ($cell->hasTransformer()) {
                $previousCriteria = $cell->getTransformer()->transform($previousResults);
            }

            if ($cell->getName()) {
                $resultsArray[$cell->getName()] = $previousResults;
                continue;
            }

            array_push($resultsArray, $previousResults);
        }

        return new ResultCollection($resultsArray);
    }

    /**
     * @param array $cells
     * @throws \InvalidArgumentException
     */
    private function validateCells(array $cells)
    {
        if (2 > count($cells)) {
            throw new \InvalidArgumentException(
                'At least two searchers are required to create a chain'
            );
        }
    }

    /**
     * @param TransformerInterface $transformer
     * @param mixed                $results
     *
     * @return bool
     */
    private function shouldSkipResults(
        TransformerInterface $transformer,
        $results
    ) {
        return null !== $results && $transformer->skip($results);
    }
}
