<?php

namespace KGzocha\Searcher\QueryCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class PaginationQueryCriteria implements PaginationQueryCriteriaInterface
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $itemsPerPage;

    /**
     * @param int $page
     * @param int $itemsPerPage
     */
    public function __construct(
        $page,
        $itemsPerPage
    ) {
        $this->page = $this->convert($page);
        $this->itemsPerPage = $this->convert($itemsPerPage);
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $this->convert($page);
    }

    /**
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     *
     * @throws \BadMethodCallException
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $this->convert($itemsPerPage);
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied()
    {
        return $this->page != 0 && $this->itemsPerPage != 0;
    }

    /**
     * @param int $number
     *
     * @return int
     */
    private function convert($number)
    {
        return abs((int) $number);
    }
}
