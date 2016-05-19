<?php

namespace KGzocha\Searcher\Criteria\Collection;

use KGzocha\Searcher\Criteria\CriteriaInterface;

/**
 * Will hold all Criteria that can be used in search process.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
interface CriteriaCollectionInterface
{
    /**
     * Will return array of CriteriaInterface
     * that returns true in shouldBeApplied().
     *
     * @return CriteriaInterface[]
     */
    public function getApplicableCriteria();

    /**
     * @return CriteriaInterface[]
     */
    public function getCriteria();

    /**
     * @param CriteriaInterface $criteria
     *
     * @return CriteriaCollectionInterface
     */
    public function addCriteria(CriteriaInterface $criteria);
}
