<?php


namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\DateTimeRangeCriteria;

class DateTimeRangeCriteriaTest extends AbstractCriteriaTestCase
{
    public function testShouldBeAppliedByDefault()
    {
        $this->assertFalse($this->getDateTimeRangeFilterModel()->shouldBeApplied());
    }

    public function testGetters()
    {
        $model = new DateTimeRangeCriteria();
        $model->setStartingDateTime($date1 = new \DateTime());
        $model->setEndingDateTime($date2 = new \DateTime());

        $this->assertEquals($date1, $model->getStartingDateTime());
        $this->assertEquals($date2, $model->getEndingDateTime());
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $expected
     * @dataProvider shouldBeAppliedDataProvider
     */
    public function testShouldBeApplied($startDate, $endDate, $expected)
    {
        $model = new DateTimeRangeCriteria($startDate, $endDate);
        $this->assertEquals($expected, $model->shouldBeApplied());
    }

    public function shouldBeAppliedDataProvider()
    {
        return [
            [new \DateTime(), new \DateTime(), true],
            [null, new \DateTime(), true],
            [new \DateTime(), null, true],

            [null, null, false],
        ];
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            $this->getDateTimeRangeFilterModel()
        );
    }

    /**
     * @return DateTimeRangeCriteria
     */
    private function getDateTimeRangeFilterModel()
    {
        return new DateTimeRangeCriteria();
    }
}
