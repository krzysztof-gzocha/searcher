<?php

use \KGzocha\Searcher\Criteria\CriteriaInterface;
use \KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface;
use \KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext;
use \KGzocha\Searcher\Context\SearchingContextInterface;
use \KGzocha\Searcher\CriteriaBuilder\Collection\CriteriaBuilderCollection;
use \KGzocha\Searcher\Criteria\Collection\CriteriaCollection;
use \KGzocha\Searcher\Searcher;

class HeightCriteria implements CriteriaInterface
{
    /**
     * @var float height in meters
     */
    private $height;

    /**
     * @param null|float $height
     */
    public function __construct($height = null)
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = (float) $height;
    }

    /**
     * @inheritDoc
     */
    public function shouldBeApplied()
    {
        return $this->height != null;
    }
}

class HeightCriteriaBuilder implements CriteriaBuilderInterface
{
    /**
     * @param HeightCriteria               $criteria
     * @param QueryBuilderSearchingContext $searchingContext
     */
    public function buildCriteria(
        CriteriaInterface $criteria,
        SearchingContextInterface $searchingContext
    ) {
        $searchingContext
            ->getQueryBuilder()
            ->andWhere('t.height = :number')
            ->setParameter('number', $criteria->getHeight());
    }

    /**
     * @inheritDoc
     */
    public function allowsCriteria(CriteriaInterface $criteria)
    {
        return $criteria instanceof HeightCriteria;
    }

    /**
     * @inheritDoc
     */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    ) {
        return $searchingContext instanceof QueryBuilderSearchingContext;
    }
}

/** @var \Doctrine\ORM\QueryBuilder $queryBuilder */
$queryBuilder = /** lets assume its already created QueryBuilder */null;

$criteria = new HeightCriteria(200);
$criteriaBuilder = new HeightCriteriaBuilder();
$context = new QueryBuilderSearchingContext($queryBuilder);

$searcher = new Searcher(
    new CriteriaBuilderCollection([$criteriaBuilder]),
    $context
);

$results = $searcher->search(new CriteriaCollection([$criteria]));

foreach ($results as $result) {
    var_dump($result);
}
