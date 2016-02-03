<?php

namespace KGzocha\Searcher\Test\Model\FilterModel;

use KGzocha\Searcher\Model\FilterModel\TextFilterModel;

class TextFilterModelTest extends AbstractFilterModelTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            $this->getTextFilterModel()
        );
    }

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
            [1.23, true],
            ['', false],
            [null, false],
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

