<?php


namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\DateTimeCriteria;

class DateTimeCriteriaTest extends AbstractCriteriaTestCase
{
    public function testImposedMethodWithoutValue()
    {
        $this->assertFalse(
            $this->getDateTimeFilterModel()
                ->shouldBeApplied()
        );
    }

    public function testImposedMethod()
    {
        $this->assertTrue(
            $this->getDateTimeFilterModel()
                ->setDateTime(new \DateTime())
                ->shouldBeApplied()
        );
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            $this->getDateTimeFilterModel()
        );
    }

    /**
     * @return DateTimeCriteria
     */
    private function getDateTimeFilterModel()
    {
        return new DateTimeCriteria();
    }
}
