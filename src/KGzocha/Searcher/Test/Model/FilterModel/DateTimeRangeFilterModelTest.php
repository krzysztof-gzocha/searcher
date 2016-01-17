<?php


namespace KGzocha\Searcher\Test\Model\FilterModel;

use KGzocha\Searcher\Model\FilterModel\DateTimeRangeFilterModel;

class DateTimeRangeFilterModelTest extends \PHPUnit_Framework_TestCase
{
    public function testImposedMethodWithoutValues()
    {
        $this->assertFalse($this->getDateTimeRangeFilterModel()->isImposed());
    }

    /**
     * @dataProvider dateTimeProvider
     */
    public function testImposedMethod($startingValue, $endingValue, $expectedResult)
    {
        $this->assertEquals(
            $this
                ->getDateTimeRangeFilterModel()
                ->setStartingDateTime($startingValue)
                ->setEndingDateTime($endingValue)
                ->isImposed(),
            $expectedResult
        );
    }

    /**
     * @return array
     */
    public function dateTimeProvider()
    {
        return [
            [new \DateTime(), new \DateTime(), true],
            [new \DateTimeImmutable(), new \DateTimeImmutable(), true],
            [new CustomDateTime(), new CustomDateTime(), true],
        ];
    }

    /**
     * @return DateTimeRangeFilterModel
     */
    private function getDateTimeRangeFilterModel()
    {
        return new DateTimeRangeFilterModel();
    }
}
