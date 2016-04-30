<?php

namespace KGzocha\Searcher\Test\FilterModel;
use KGzocha\Searcher\FilterModel\FilterModelInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\FilterModel
 */
abstract class AbstractFilterModelTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param FilterModelInterface $model
     */
    protected function checkIfImplementsInterface($model)
    {
        $this->assertInstanceOf(
            'KGzocha\Searcher\FilterModel\FilterModelInterface',
            $model
        );
    }
}
