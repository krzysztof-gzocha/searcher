<?php

namespace KGzocha\Searcher\Test\Model\FilterModel\Adapter;

use KGzocha\Searcher\Model\FilterModel\Adapter\ImmutablePaginationAdapter;
use KGzocha\Searcher\Test\Model\FilterModel\PaginationFilterModelTest;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ImmutablePaginationAdapterTest extends PaginationFilterModelTest
{
    public function testNotChangableItemsPerPage()
    {
        $model = $this->getFilterModel(1, 100);
        $model->setPage(2);
        $model->setItemsPerPage(50);
        $model->setItemsPerPage(250);

        $this->assertEquals(100, $model->getItemsPerPage());
    }

    /**
     * @inheritDoc
     */
    protected function getFilterModel($page, $itemsPerPage)
    {
        return new ImmutablePaginationAdapter(
            parent::getFilterModel($page, $itemsPerPage)
        );
    }
}
