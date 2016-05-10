<?php

namespace KGzocha\Searcher\QueryCriteria\Adapter;

use KGzocha\Searcher\QueryCriteria\PaginationQueryCriteriaInterface;

/**
 * This adapter will not allow to change itemsPerPage parameter in adapted pagination QueryCriteria.
 * Every other behaviour will be untouched.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ImmutablePaginationAdapter implements PaginationQueryCriteriaInterface
{
    /**
     * @var PaginationQueryCriteriaInterface
     */
    private $pagination;

    /**
     * @param PaginationQueryCriteriaInterface $pagination
     */
    public function __construct(PaginationQueryCriteriaInterface $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage()
    {
        return $this->pagination->getPage();
    }

    /**
     * {@inheritdoc}
     */
    public function getItemsPerPage()
    {
        return $this->pagination->getItemsPerPage();
    }

    /**
     * {@inheritdoc}
     */
    public function setPage($page)
    {
        return $this->pagination->setPage($page);
    }

    /**
     * This method will not allow to change items per page.
     * On each call it will set the same value.
     *
     * {@inheritdoc}
     */
    public function setItemsPerPage($itemsPerPage)
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
    public function shouldBeApplied()
    {
        return $this->pagination->shouldBeApplied();
    }
}
