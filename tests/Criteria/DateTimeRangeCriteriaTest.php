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
        $this->assertTrue(
            $this
                ->getDateTimeRangeFilterModel()
                ->setStartingDateTime(new \DateTime())
                ->setEndingDateTime(new \DateTime())
                ->shouldBeApplied()
        );
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
