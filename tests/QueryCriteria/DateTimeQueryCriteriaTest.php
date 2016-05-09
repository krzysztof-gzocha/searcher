<?php


namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\DateTimeQueryCriteria;

class DateTimeQueryCriteriaTest extends AbstractQueryCriteriaTestCase
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
     * @return DateTimeQueryCriteria
     */
    private function getDateTimeFilterModel()
    {
        return new DateTimeQueryCriteria();
    }
}
