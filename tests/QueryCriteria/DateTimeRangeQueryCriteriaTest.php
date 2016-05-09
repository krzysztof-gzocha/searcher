<?php


namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\DateTimeRangeQueryCriteria;

class DateTimeRangeQueryCriteriaTest extends AbstractQueryCriteriaTestCase
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
     * @return DateTimeRangeQueryCriteria
     */
    private function getDateTimeRangeFilterModel()
    {
        return new DateTimeRangeQueryCriteria();
    }
}
