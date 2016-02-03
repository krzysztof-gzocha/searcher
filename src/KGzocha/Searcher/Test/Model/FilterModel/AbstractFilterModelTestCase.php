<?php

namespace KGzocha\Searcher\Test\Model\FilterModel;
use KGzocha\Searcher\Model\FilterModel\FilterModelInterface;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\Model\FilterModel
 */
abstract class AbstractFilterModelTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param FilterModelInterface $model
     */
    protected function checkIfImplementsInterface($model)
    {
        $this->assertInstanceOf(
            'KGzocha\Searcher\Model\FilterModel\FilterModelInterface',
            $model
        );
    }
}
