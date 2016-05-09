<?php

namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\TextQueryCriteria;

class TextQueryCriteriaTest extends AbstractQueryCriteriaTestCase
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
     * @return TextQueryCriteria
     */
    private function getTextFilterModel()
    {
        return new TextQueryCriteria();
    }
}

