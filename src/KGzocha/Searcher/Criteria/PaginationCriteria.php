<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class PaginationCriteria implements PaginationCriteriaInterface
{
    /**
     * @var int|null
     */
    private $page;

    /**
     * @var int|null
     */
    private $itemsPerPage;

    /**
     * @param int $page
     * @param int $itemsPerPage
     */
    public function __construct(
        int $page = null,
        int $itemsPerPage = null
    ) {
        $this->setPage($page);
        $this->setItemsPerPage($itemsPerPage);
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page = null)
    {
        $this->page = $this->convert($page);
    }

    /**
     * @return int|null
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
    public function setItemsPerPage(int $itemsPerPage = null)
    {
        $this->itemsPerPage = $this->convert($itemsPerPage);
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->page !== 0 && $this->itemsPerPage !== 0;
    }

    /**
     * @param int $number
     *
     * @return int
     */
    private function convert(int $number = null): int
    {
        return (int) abs($number);
    }
}
