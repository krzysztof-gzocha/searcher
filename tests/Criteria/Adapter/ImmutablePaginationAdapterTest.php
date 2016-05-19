<?php

namespace KGzocha\Searcher\Test\Criteria\Adapter;

use KGzocha\Searcher\Criteria\Adapter\ImmutablePaginationAdapter;
use KGzocha\Searcher\Test\Criteria\PaginationCriteriaTest;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ImmutablePaginationAdapterTest extends PaginationCriteriaTest
{
    public function testNotChangeableItemsPerPage()
    {
        $model = $this->getCriteria(1, 100);
        $model->setPage(2);
        $model->setItemsPerPage(50);
        $model->setItemsPerPage(250);

        $this->assertEquals(100, $model->getItemsPerPage());
    }

    /**
     * @inheritDoc
     */
    protected function getCriteria($page, $itemsPerPage)
    {
        return new ImmutablePaginationAdapter(
            parent::getCriteria($page, $itemsPerPage)
        );
    }
}
