<?php


namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\DateTimeCriteria;

class DateTimeCriteriaTest extends AbstractCriteriaTestCase
{
    public function testImposedMethodWithoutValue()
    {
        $this->assertFalse(
            $this->getDateTimeFilterModel()->shouldBeApplied()
        );
    }

    public function testImposedMethod()
    {
        $model = $this->getDateTimeFilterModel();
        $this->assertTrue(
            $model
                ->setDateTime($dateTime = new \DateTime())
                ->shouldBeApplied()
        );

        $this->assertEquals($dateTime, $model->getDateTime());
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
