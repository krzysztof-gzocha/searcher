<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Criteria\Adapter;

use KGzocha\Searcher\Criteria\PaginationCriteriaInterface;

/**
 * This adapter will not allow to change itemsPerPage parameter in adapted pagination Criteria.
 * Every other behaviour will be untouched.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ImmutablePaginationAdapter implements PaginationCriteriaInterface
{
    /**
     * @var PaginationCriteriaInterface
     */
    private $pagination;

    /**
     * @param PaginationCriteriaInterface $pagination
     */
    public function __construct(PaginationCriteriaInterface $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage(): int
    {
        return $this->pagination->getPage();
    }

    /**
     * {@inheritdoc}
     */
    public function getItemsPerPage(): int
    {
        return $this->pagination->getItemsPerPage();
    }

    /**
     * {@inheritdoc}
     */
    public function setPage(int $page = null)
    {
        return $this->pagination->setPage($page);
    }

    /**
     * This method will not allow to change items per page.
     * On each call it will set the same value.
     *
     * {@inheritdoc}
     */
    public function setItemsPerPage(int $itemsPerPage = null)
    {
        return $this
            ->pagination
            ->setItemsPerPage(
                $this->pagination->getItemsPerPage()
            );
    }

    /**
     * {@inheritdoc}
     */
    public function shouldBeApplied(): bool
    {
        return $this->pagination->shouldBeApplied();
    }
}
