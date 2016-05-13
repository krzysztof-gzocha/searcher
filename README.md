# Searcher [![Build Status](https://travis-ci.org/krzysztof-gzocha/searcher.svg?branch=master)](https://travis-ci.org/krzysztof-gzocha/searcher) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/krzysztof-gzocha/searcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/krzysztof-gzocha/searcher/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/krzysztof-gzocha/searcher/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/krzysztof-gzocha/searcher/?branch=master)

### What is that?
*Searcher* is a library created in order to simplify construction of complex searching queries basing on passed criteria.
It's basic idea is to split each searching *filter* to separate class.
Supported PHP versions: >=5.4, 7 and HHVM.

### Why?
Did you ever seen code responsible for searching some entities basing on many different criteria? It can be quite a mess!
Imagine that you have a form with 20 fields and all of them have their impact on searching conditions.
It's maybe not a great idea to pass whole form to some service at let it parse everything in one place.
Thanks to this library you can split the responsibility of building query criteria to several smaller classes. One class per filter. One `QueryCriteriaBuilder` per `QueryCriteria`. In this way inside `QueryCriteriaBuilder` you care only for one `QueryCriteria`, which makes it a lot more readable.
You can later use exactly the same `QueryCriteria` for different search, with different `QueryCriteriaBuilder` and even different `SearchingContext` which can use even different database.

### Installation
You can install the library via composer by typing in terminal:
```bash
$ composer require krzysztof-gzocha/searcher
```

### Integration
Integration with Symfony is done in **[SearcherBundle](https://github.com/krzysztof-gzocha/searcher-bundle)**

### Idea
 - `QueryCriteriaBuilder` - will build new *conditions* for single `QueryCriteria`,
 - `QueryCriteria` - model that will be passed to `QueryCriteriaBuilder`. You just need to hydrate it somehow, so it will be useful. Criteria can hold multiple fields inside and all (or some) of them might be used inside `QueryCriteriaBuilder`,
 - `SearchingContext` - context of single search. This service should know how to fetch results from constructed query and it holds something called `QueryBuilder`, but it can be anything that works for you - any service. This is an abstraction layer between search and database. There are different contexts for Doctrine's ORM, ODM, Elastica and so on. If there is no context for you you can implement one - it's shouldn't be hard,
 - `Searcher` - holds collection of `QueryCriteriaBuilder` and will pass `Criteria` to appropriate `QueryCriteriaBuilder`.

### Example
Let's say we want to search for **people** whose **age** is in some filtered range.
In this example we will use Doctrine's QueryBuilder, so we will use `QueryBuilderSearchingContext` and will specify in our `QueryCriteriaBuidler` that it should interact only with `Doctrine\ORM\QueryBuilder`, but remember that we do **not** have to use only Doctrine.

#### 1. QueryCriteria
First of all we would need to create `AgeRangeQueryCriteria` - the class that will holds values of minimal and maximal age. There are already implemented default `QueryCriteria` in [here](https://github.com/krzysztof-gzocha/searcher/tree/master/src/KGzocha/Searcher/QueryCriteria).
```php
class AgeRangeQueryCriteria implements QueryCriteriaInterface
{
    private $minimalAge;
    private $maximalAge;

    /**
    * Only required method.
    * If will return true, then it will be passed to some of the QueryCriteriaBuilder(s)
    */
    public function shouldBeApplied()
    {
        return null !== $this->minimalAge && null !== $this->maximalAge;
    }

    // getters, setters, whatever
}
```

#### 2. QueryCriteriaBuilder
In second step we would like to specify conditions that should be imposed for this model.
That's why we would need to create `AgeRangeQueryCriteriaBuilder`
```php
class AgeRangeQueryCriteriaBuilder implements QueryCriteriaBuilderInterface
{
    public function buildCriteria(
        QueryCriteriaInterface $queryCriteria,
        SearchingContextInterface $searchingContext
    ) {
        $searchingContext
            ->getQueryBuilder()
            ->andWhere('e.age >= :minimalAge')
            ->andWhere('e.age <= :maximalAge')
            ->setParameter('minimalAge', $queryCriteria->getMinimalAge())
            ->setParameter('maximalAge', $queryCriteria->getMaximalAge());
    }

    public function allowsCriteria(
        QueryCriteriaInterface $queryCriteria
    ) {
        return $queryCriteria instanceof AgeRangeQueryCriteria;
    }

    /**
    * You can skip this method if you will extend from AbstractORMQueryCriteriaBuilder.
    */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    ) {
        return $searchingContext instanceof \Doctrine\ORM\QueryBuilder;
    }
}
```
#### 3. Collections
In next steps we would need to create collections for both: `QueryCriteria` and `QueryCriteriaBuidler`.
```php
$builders = new QueryCriteriaBuilderCollection();

$builders->addQueryCriteriaBuilder(new AgeRangeQueryCriteriaBuilder());
$builders->addQueryCriteriaBuilder(/** rest of builders */);
```
```php
$ageRangeCriteria = new AgeRangeQueryCriteria();

// We have to populate the model before searching
$ageRangeCriteria->setMinimalAge(23);
$ageRangeCriteria->setMaximalAge(29);

$criteria = new QueryCriteriaCollection();
$criteria->addQueryCriteria($ageRangeCriteria);
$criteria->addQueryCriteria(/** rest of criteria */);
```

#### 4. SearchingContext
Now we would like to create our `SearchingContext` and populate it with QueryBuilder taken from Doctrine ORM.
```php
$context  = new QueryBuilderSearchingContext($queryBuilder);

$searcher = new Searcher($builders, $context);
$searcher->search($models); // Yay, we have our results!
```

If there is even small chance that your QueryBuilder will return `null` when you are expecting traversable object or array then you can use `WrappedResultsSearcher` instead of normal `Searcher` class. It will act exactly the same as `Searcher`, but it will return `ResultCollection`, which will work only with array or `\Traversable` and if result will be just `null` your code will still work. Here is how it will looks like:
```php
$searcher = new WrappedResultsSearcher(new Searcher($builders, $context));
$results = $searcher->search($model);  // instance of ResultCollection
foreach ($results as $result) {
    // will work!
}

foreach ($results->getResults() as $result) {
    // Since ResultCollection has method getResults() this will also work!
}
```
### Order
In order to sort your results you can make use of already implemented `QueryCriteria`. You don't need to implement it from scratch. Keep in mind that you still need to implement your `QueryCriteriaBuilder` for it (this feature is still under development).  Let's say you want to order your results and you need value `p.id` in your QueryCriteriaBuidler to do it, but you would like to show it as `pid` to end-user. Nothing simpler!
This is how you can create OrderByQueryCriteria:
```php
$mappedFields = ['pid' => 'p.id', 'valueForUser' => 'valueForBuilder'];
$criteria = new MappedOrderByAdapter(
    new OrderByQueryCriteria('pid'),
    $mappedFields
);
// $criteria->getMappedOrderBy() = 'p.id'
// $criteria->getOrderBy() = 'pid'
```
Of course you don't need to use `MappedOrderByAdapter` - you can use just `OrderByQueryCriteria`, but then user will know exactly what fields are beeing used to sort.
### Pagination
`QueryCriteria` for pagination is also implemented and you don't need to do it, but keep in mind that you still need to implement `QueryCriteriaBuilder` that will make use of it and do actual pagination (this feature is under development).
Let's say you want to allow your end-user to change pages, but not number of items per page.
You can use this example code:
```php
$criteria = new ImmutablePaginationAdapter(
  new PaginationQueryCriteria($page = 1, $itemsPerPage = 50)
);
// $criteria->setItemsPerPage(250);    <- use can try to change it
// $criteria->getItemsPerPage() = 50   <- but he can't actualy do it
// $criteria->getPage() = 1
```
Of course if you want to allow user to change number of items per page also you can skip the `ImmutablePaginationAdapter` and use just `PaginationQueryCriteria`.

### Contributing
All ideas and pull requests are welcomed and appreciated :)

### Development
Command to run test: `composer test`

### Thanks to
In alphabetical order
- https://github.com/chkris 
- https://github.com/pawelhertman 
- https://github.com/ustrugany 
- https://github.com/wojciech-olszewski


#### License
License: MIT
Author: Krzysztof Gzocha [@kgzocha](https://twitter.com/kgzocha)
