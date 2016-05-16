<?php

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface PaginationCriteriaInterface extends CriteriaInterface
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
