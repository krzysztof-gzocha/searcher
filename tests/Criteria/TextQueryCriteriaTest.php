<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\TextCriteria;

class TextCriteriaTest extends AbstractCriteriaTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            $this->getTextFilterModel()
        );
    }

    public function testImposedMethodWithoutValue()
    {
        $this->assertFalse($this->getTextFilterModel()->shouldBeApplied());
    }

    /**
     * @param $value
     * @param $expectedResult
     *
     * @dataProvider textDataProvider
     */
    public function testImposedMethod($value, $expectedResult)
    {
        $this->assertEquals(
            $this->getTextFilterModel()->setText($value)->shouldBeApplied(),
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
     * @return TextCriteria
     */
    private function getTextFilterModel()
    {
        return new TextCriteria();
    }
}

