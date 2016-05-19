<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\PaginationCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class PaginationCriteriaTest extends AbstractCriteriaTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface($this->getCriteria(1, 50));
    }

    /**
     * @param $page
     * @param $itemsPerPage
     * @dataProvider dataProvider
     */
    public function testImposedWithValue($page, $itemsPerPage)
    {
        $this->assertTrue($this->getCriteria($page, $itemsPerPage)->shouldBeApplied());
    }

    public function testImposedWithoutValue()
    {
        $this->assertFalse($this->getCriteria(0, 0)->shouldBeApplied());
    }

    /**
     * @param $page
     * @param $itemsPerPage
     * @dataProvider negativeDataProvider
     */
    public function testNegativeValues($page, $itemsPerPage)
    {
        // Testing constructor
        $model = $this->getCriteria($page, $itemsPerPage);
        $this->assertEquals($model->getPage(), abs((int) $page));
        $this->assertEquals($model->getItemsPerPage(), abs((int) $itemsPerPage));

        // Testing setters
        $model->setPage($page);
        $model->setItemsPerPage($itemsPerPage);
        $this->assertEquals($model->getPage(), abs((int) $page));
        $this->assertEquals($model->getItemsPerPage(), abs((int) $itemsPerPage));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [1, 50],
            [5, 25],
            [11234, 11233],
        ];
    }

    /**
     * @return array
     */
    public function negativeDataProvider()
    {
        return [
            [-1, -50],
            [-5, -25],
            [-11234, -11233],
        ];
    }

    /**
     * @param $page
     * @param $itemsPerPage
     *
     * @return PaginationCriteria
     */
    protected function getCriteria($page, $itemsPerPage)
    {
        return new PaginationCriteria($page, $itemsPerPage);
    }
}
