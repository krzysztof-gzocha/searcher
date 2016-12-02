<?php
declare(strict_types=1);

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
    public function setPage(int $page = null);

    /**
     * @param int $itemsPerPage
     */
    public function setItemsPerPage(int $itemsPerPage = null);
}
