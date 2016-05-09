<?php

namespace KGzocha\Searcher\Test\QueryCriteria\Adapter;

use KGzocha\Searcher\QueryCriteria\Adapter\ImmutablePaginationAdapter;
use KGzocha\Searcher\Test\QueryCriteria\PaginationQueryCriteriaTest;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ImmutablePaginationAdapterTest extends PaginationQueryCriteriaTest
{
    public function testNotChangeableItemsPerPage()
    {
        $model = $this->getQueryCriteria(1, 100);
        $model->setPage(2);
        $model->setItemsPerPage(50);
        $model->setItemsPerPage(250);

        $this->assertEquals(100, $model->getItemsPerPage());
    }

    /**
     * @inheritDoc
     */
    protected function getQueryCriteria($page, $itemsPerPage)
    {
        return new ImmutablePaginationAdapter(
            parent::getQueryCriteria($page, $itemsPerPage)
        );
    }
}
