<?php

namespace KGzocha\Searcher\Model\FilterModel\Adapter;

use KGzocha\Searcher\Model\FilterModel\PaginationFilterModelInterface;

/**
 * This adapter will not allow to change itemsPerPage parameter in adapter pagination filter model.
 * Every other behaviour will stay as it is.
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ImmutablePaginationAdapter implements PaginationFilterModelInterface
{
    /**
     * @var PaginationFilterModelInterface
     */
    private $pagination;

    /**
     * @param PaginationFilterModelInterface $pagination
     */
    public function __construct(PaginationFilterModelInterface $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @inheritDoc
     */
    public function getPage()
    {
        return $this->pagination->getPage();
    }

    /**
     * @inheritDoc
     */
    public function getItemsPerPage()
    {
        return $this->pagination->getItemsPerPage();
    }

    /**
     * @inheritDoc
     */
    public function setPage($page)
    {
        return $this->pagination->setPage($page);
    }

    /**
     * This method will not allow to change items per page.
     * On each call it will set the same value
     * @inheritDoc
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
     * @inheritDoc
     */
    public function isImposed()
    {
        return $this->pagination->isImposed();
    }
}
