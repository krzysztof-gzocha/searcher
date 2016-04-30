<?php


namespace KGzocha\Searcher\Test\FilterModel;

use KGzocha\Searcher\FilterModel\DateTimeRangeFilterModel;

class DateTimeRangeFilterModelTest extends AbstractFilterModelTestCase
{
    public function testImposedMethodWithoutValues()
    {
        $this->assertFalse($this->getDateTimeRangeFilterModel()->isImposed());
    }

    public function testImposedMethod() {
        $this->assertTrue(
            $this
                ->getDateTimeRangeFilterModel()
                ->setStartingDateTime(new \DateTime())
                ->setEndingDateTime(new \DateTime())
                ->isImposed()
        );
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            $this->getDateTimeRangeFilterModel()
        );
    }

    /**
     * @return DateTimeRangeFilterModel
     */
    private function getDateTimeRangeFilterModel()
    {
        return new DateTimeRangeFilterModel();
    }
}
