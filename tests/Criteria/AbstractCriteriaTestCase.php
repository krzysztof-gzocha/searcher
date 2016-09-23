<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\CriteriaInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
abstract class AbstractCriteriaTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param CriteriaInterface $model
     */
    protected function checkIfImplementsInterface($model)
    {
        $this->assertInstanceOf(
            'KGzocha\Searcher\Criteria\CriteriaInterface',
            $model
        );
    }
}
