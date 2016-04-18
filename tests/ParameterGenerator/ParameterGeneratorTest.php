<?php

namespace KGzocha\Searcher\Test\ParameterGenerator;

use KGzocha\Searcher\ParameterGenerator\ParameterGenerator;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\ParameterGenerator
 */
class ParameterGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testParameterUniqueness()
    {
        $generator = new ParameterGenerator();
        $iterations = 100;

        $parameters = [];
        for ($i = 0; $i < $iterations; ++$i) {
            $parameters[$generator->getParameterName()] = true;
        }

        $this->assertCount($iterations, $parameters);
    }

    public function testPrefix()
    {
        $generator = new ParameterGenerator('someOtherPrefix');
        $this->assertEquals('someOtherPrefix1', $generator->getParameterName());
    }
}
