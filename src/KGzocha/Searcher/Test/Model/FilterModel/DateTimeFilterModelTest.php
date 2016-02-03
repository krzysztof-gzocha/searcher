<?php


namespace KGzocha\Searcher\Test\Model\FilterModel;

use KGzocha\Searcher\Model\FilterModel\DateTimeFilterModel;

class DateTimeFilterModelTest extends AbstractFilterModelTestCase
{
    public function testImposedMethodWithoutValue()
    {
        $this->assertFalse(
            $this->getDateTimeFilterModel()
                ->isImposed()
        );
    }

    public function testImposedMethod()
    {
        $this->assertTrue(
            $this->getDateTimeFilterModel()
                ->setDateTime(new \DateTime())
                ->isImposed()
        );
    }

    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface(
            $this->getDateTimeFilterModel()
        );
    }

    /**
     * @return DateTimeFilterModel
     */
    private function getDateTimeFilterModel()
    {
        return new DateTimeFilterModel();
    }
}
