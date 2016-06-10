<?php


namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\DateTimeRangeCriteria;

class DateTimeRangeCriteriaTest extends AbstractCriteriaTestCase
{
    public function testImposedMethodWithoutValues()
    {
        $this->assertFalse($this->getDateTimeRangeFilterModel()->shouldBeApplied());
    }

    public function testImposedMethod() {
        $model = $this->getDateTimeRangeFilterModel();
        $this->assertTrue(
            $model
                ->setStartingDateTime($startDate = new \DateTime())
                ->setEndingDateTime($endDate = new \DateTime())
                ->shouldBeApplied()
        );

        $this->assertEquals($startDate, $model->getStartingDateTime());
        $this->assertEquals($endDate, $model->getEndingDateTime());
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
