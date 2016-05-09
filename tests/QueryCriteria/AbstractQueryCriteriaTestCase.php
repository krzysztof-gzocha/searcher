<?php

namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
abstract class AbstractQueryCriteriaTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param QueryCriteriaInterface $model
     */
    protected function checkIfImplementsInterface($model)
    {
        $this->assertInstanceOf(
            'KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface',
            $model
        );
    }
}
