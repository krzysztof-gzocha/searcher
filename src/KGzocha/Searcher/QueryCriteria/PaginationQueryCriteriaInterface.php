<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface PaginationQueryCriteriaInterface extends QueryCriteriaInterface
{
    /**
     * @return int
     */
    public function getPage();

    /**
     * @return int
     */
    public function getItemsPerPage();

    /**
     * @param int $page
     */
    public function setPage($page);

    /**
     * @param int $itemsPerPage
     */
    public function setItemsPerPage($itemsPerPage);
}
