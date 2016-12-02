<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Context;

/**
 * This class should be extended and make sure that QueryBuilder's type
 * is correct for all required CriteriaBuilders.
 *
 * @author Krzysztof Gzocha
 */
abstract class AbstractSearchingContext implements SearchingContextInterface
{
    /**
     * @var mixed query builder or any other service required by filter imposers.
     */
    private $queryBuilder;

    /**
     * This method can be overwritten in extending SearchingContext's in
     * order to provide strict type for QueryBuilder.
     *
     * @param mixed $queryBuilder will be used in CriteriaBuilders to impose
     *                            all the conditions.
     */
    public function __construct($queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
}
