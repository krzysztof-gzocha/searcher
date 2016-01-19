<?php


namespace KGzocha\Searcher\Test\Model\FilterModel;

use KGzocha\Searcher\Model\FilterModel\DateTimeFilterModel;

class DateTimeFilterModelTest extends \PHPUnit_Framework_TestCase
{
    public function testImposedMethodWithoutValue()
    {
        $this->assertFalse($this->getDateTimeFilterModel()->isImposed());
    }

    /**
     * @dataProvider dateTimeProvider
     */
    public function testImposedMethod($value, $expectedResult)
    {
        $this->assertEquals(
            $this->getDateTimeFilterModel()->setDateTime($value)->isImposed(),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function dateTimeProvider()
    {
        return [
            [new \DateTime(), true],
            [new CustomDateTime(), true],
        ];
    }

    /**
     * @return DateTimeFilterModel
     */
    private function getDateTimeFilterModel()
    {
        return new DateTimeFilterModel();
    }
}
