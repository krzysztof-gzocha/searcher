<?php

namespace KGzocha\Searcher\Test\Model\FilterModel;

use KGzocha\Searcher\Model\FilterModel\TextFilterModel;

class TextFilterModelTest extends \PHPUnit_Framework_TestCase
{
    public function testImposedMethodWithoutValue()
    {
        $this->assertFalse($this->getTextFilterModel()->isImposed());
    }

    /**
     * @dataProvider textDataProvider
     */
    public function testImposedMethod($value, $expectedResult)
    {
        $this->assertEquals(
            $this->getTextFilterModel()->setText($value)->isImposed(),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function textDataProvider()
    {
        return [
            ['a', true],
            ['ab', true],
            ['some longer text', true],
            ['1', true],
            ['[]', true],

            ['', false],
            [null, false],
            [new \stdClass, false],
        ];
    }

    /**
     * @return TextFilterModel
     */
    private function getTextFilterModel()
    {
        return new TextFilterModel();
    }
}

