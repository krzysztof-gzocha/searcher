<?php
namespace KGzocha\Searcher\FilterModel;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface PaginationFilterModelInterface extends FilterModelInterface
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
