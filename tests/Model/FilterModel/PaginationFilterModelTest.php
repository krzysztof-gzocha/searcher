<?php

namespace KGzocha\Searcher\Test\Model\FilterModel;

use KGzocha\Searcher\Model\FilterModel\PaginationFilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class PaginationFilterModelTest extends AbstractFilterModelTestCase
{
    public function testIfImplementsInterface()
    {
        $this->checkIfImplementsInterface($this->getFilterModel(1, 50));
    }

    /**
     * @param $page
     * @param $itemsPerPage
     * @dataProvider dataProvider
     */
    public function testImposedWithValue($page, $itemsPerPage)
    {
        $this->assertTrue($this->getFilterModel($page, $itemsPerPage)->isImposed());
    }

    public function testImposedWithoutValue()
    {
        $this->assertFalse($this->getFilterModel(0, 0)->isImposed());
    }

    /**
     * @param $page
     * @param $itemsPerPage
     * @dataProvider negativeDataProvider
     */
    public function testNegativeValues($page, $itemsPerPage)
    {
        // Testing constructor
        $model = $this->getFilterModel($page, $itemsPerPage);
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
     * @return PaginationFilterModel
     */
    protected function getFilterModel($page, $itemsPerPage)
    {
        return new PaginationFilterModel($page, $itemsPerPage);
    }
}
