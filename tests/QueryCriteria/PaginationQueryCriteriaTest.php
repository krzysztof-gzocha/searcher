<?php

namespace KGzocha\Searcher\Test\QueryCriteria;

use KGzocha\Searcher\QueryCriteria\PaginationQueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class PaginationQueryCriteriaTest extends AbstractQueryCriteriaTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface($this->getQueryCriteria(1, 50));
    }

    /**
     * @param $page
     * @param $itemsPerPage
     * @dataProvider dataProvider
     */
    public function testImposedWithValue($page, $itemsPerPage)
    {
        $this->assertTrue($this->getQueryCriteria($page, $itemsPerPage)->shouldBeApplied());
    }

    public function testImposedWithoutValue()
    {
        $this->assertFalse($this->getQueryCriteria(0, 0)->shouldBeApplied());
    }

    /**
     * @param $page
     * @param $itemsPerPage
     * @dataProvider negativeDataProvider
     */
    public function testNegativeValues($page, $itemsPerPage)
    {
        // Testing constructor
        $model = $this->getQueryCriteria($page, $itemsPerPage);
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
     * @return PaginationQueryCriteria
     */
    protected function getQueryCriteria($page, $itemsPerPage)
    {
        return new PaginationQueryCriteria($page, $itemsPerPage);
    }
}
