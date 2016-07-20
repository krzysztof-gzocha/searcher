<img align="right" src="https://camo.githubusercontent.com/03659f3fcddeaec49aa2f494c1d4aff0ec9cbd36/687474703a2f2f7777772e636c6b65722e636f6d2f636c6970617274732f612f632f612f382f31313934393936353638313938333637303238396b63616368656772696e642e7376672e7468756d622e706e67"/>

# Searcher [![Build Status](https://travis-ci.org/krzysztof-gzocha/searcher.svg?branch=master)](https://travis-ci.org/krzysztof-gzocha/searcher) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/krzysztof-gzocha/searcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/krzysztof-gzocha/searcher/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/krzysztof-gzocha/searcher/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/krzysztof-gzocha/searcher/?branch=master) [![Latest Stable Version](https://poser.pugx.org/krzysztof-gzocha/searcher/v/stable)](https://packagist.org/packages/krzysztof-gzocha/searcher) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/2b7df098-46c6-43e1-ac94-b0eab3d46401/mini.png)](https://insight.sensiolabs.com/projects/2b7df098-46c6-43e1-ac94-b0eab3d46401)

### What is that?
*Searcher* is a framework-agnostic search query builder. Search queries are written using criterias and can be run against MySQL, MongoDB, ElasticSearch, files or whatever else you like.
Supported PHP versions: >=5.4, 7 and HHVM.

### Why?
Have you ever seen code responsible for searching for something based on many different criteria? It can become quite a mess!
Imagine you have a form with 20 fields and all of them have some impact on searching conditions.
It's not a great idea to pass a whole form to some service at let it parse everything in one place.
Thanks to this library you can split the responsibility of building query criteria to several smaller classes. One class per filter. One `CriteriaBuilder` per `Criteria`.
This way, inside `CriteriaBuilder` you care only about one `Criteria`, which makes it a lot more readable and maintanable.
You can later use exactly the same `Criteria` for different searches, with different `CriteriaBuilder` and even different `SearchingContext` which can use even different databases.
You can even use searcher to find **files** on your system thanks to `FinderSearchingContext`.

### Full documentation
Full documentation can be found at [http://searcher.rtfd.io/](http://searcher.readthedocs.io/en/stable/introduction.html)

### Installation
You can install the library via composer by typing in terminal:
```bash
$ composer require krzysztof-gzocha/searcher
```

### Integration
Integration with Symfony is done in **[SearcherBundle](https://github.com/krzysztof-gzocha/searcher-bundle)**

### Idea
 - `CriteriaBuilder` - will build new *conditions* for single `Criteria`,
 - `Criteria` - model that will be passed to `CriteriaBuilder`. You just need to hydrate it somehow, so it will be useful. Criteria can hold multiple fields inside and all (or some) of them might be used inside `CriteriaBuilder`,
 - `SearchingContext` - context of single search. This service should know how to fetch results from constructed query and it holds something called `QueryBuilder`, but it can be anything that works for you - any service. This is an abstraction layer between search and database. There are different contexts for Doctrine's ORM, ODM, Elastica, *Files* and so on. If there is no context for you you can implement one - it's shouldn't be hard,
 - `Searcher` - holds collection of `CriteriaBuilder` and will pass `Criteria` to appropriate `CriteriaBuilder`.

### Example
Let's say we want to search for **people** whose **age** is in some filtered range.
In this example we will use Doctrine's QueryBuilder, so we will use `QueryBuilderSearchingContext` and will specify in our `CriteriaBuidler` that it should interact only with `Doctrine\ORM\QueryBuilder`, but remember that we do **not** have to use only Doctrine.

#### 1. Criteria
First of all we would need to create `AgeRangeCriteria` - the class that will holds values of minimal and maximal age. There are already implemented default `Criteria` in [here](https://github.com/krzysztof-gzocha/searcher/tree/master/src/KGzocha/Searcher/Criteria).
```php
class AgeRangeCriteria implements CriteriaInterface
{
    private $minimalAge;
    private $maximalAge;

    /**
    * Only required method.
    * If will return true, then it will be passed to some of the CriteriaBuilder(s)
    */
    public function shouldBeApplied()
    {
        return null !== $this->minimalAge && null !== $this->maximalAge;
    }

    // getters, setters, whatever
}
```

#### 2. CriteriaBuilder
In second step we would like to specify conditions that should be imposed for this model.
That's why we would need to create `AgeRangeCriteriaBuilder`
```php
class AgeRangeCriteriaBuilder implements CriteriaBuilderInterface
{
    public function buildCriteria(
        CriteriaInterface $criteria,
        SearchingContextInterface $searchingContext
    ) {
        $searchingContext
            ->getQueryBuilder()
            ->andWhere('e.age >= :minimalAge')
            ->andWhere('e.age <= :maximalAge')
            ->setParameter('minimalAge', $criteria->getMinimalAge())
            ->setParameter('maximalAge', $criteria->getMaximalAge());
    }

    public function allowsCriteria(
        CriteriaInterface $criteria
    ) {
        return $criteria instanceof AgeRangeCriteria;
    }

    /**
    * You can skip this method if you will extend from AbstractORMCriteriaBuilder.
    */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    ) {
        return $searchingContext instanceof QueryBuilderSearchingContext;
    }
}
```
#### 3. Collections
In next steps we would need to create collections for both: `Criteria` and `CriteriaBuidler`.
```php
$builders = new CriteriaBuilderCollection();

$builders->addCriteriaBuilder(new AgeRangeCriteriaBuilder());
$builders->addCriteriaBuilder(/** rest of builders */);
```
```php
$ageRangeCriteria = new AgeRangeCriteria();

// We have to populate the model before searching
$ageRangeCriteria->setMinimalAge(23);
$ageRangeCriteria->setMaximalAge(29);

$criteria = new CriteriaCollection();
$criteria->addCriteria($ageRangeCriteria);
$criteria->addCriteria(/** rest of criteria */);
```

#### 4. SearchingContext
Now we would like to create our `SearchingContext` and populate it with QueryBuilder taken from Doctrine ORM.
```php
$context  = new QueryBuilderSearchingContext($queryBuilder);

$searcher = new Searcher($builders, $context);
$searcher->search($criteriaCollection); // Yay, we have our results!
```

If there is even small chance that your QueryBuilder will return `null` when you are expecting traversable object or array then you can use `WrappedResultsSearcher` instead of normal `Searcher` class. It will act exactly the same as `Searcher`, but it will return `ResultCollection`, which will work only with array or `\Traversable` and if result will be just `null` your code will still work. Here is how it will looks like:
```php
$searcher = new WrappedResultsSearcher(new Searcher($builders, $context));
$results = $searcher->search($criteriaCollection);  // instance of ResultCollection
foreach ($results as $result) {
    // will work!
}

foreach ($results->getResults() as $result) {
    // Since ResultCollection has method getResults() this will also work!
}
```
### Order
In order to sort your results you can make use of already implemented `Criteria`. You don't need to implement it from scratch. Keep in mind that you still need to implement your `CriteriaBuilder` for it (this feature is still under development).  Let's say you want to order your results and you need value `p.id` in your CriteriaBuidler to do it, but you would like to show it as `pid` to end-user. Nothing simpler!
This is how you can create OrderByCriteria:
```php
$mappedFields = ['pid' => 'p.id', 'valueForUser' => 'valueForBuilder'];
$criteria = new MappedOrderByAdapter(
    new OrderByCriteria('pid'),
    $mappedFields
);
// $criteria->getMappedOrderBy() = 'p.id'
// $criteria->getOrderBy() = 'pid'
```
Of course you don't need to use `MappedOrderByAdapter` - you can use just `OrderByCriteria`, but then user will know exactly what fields are beeing used to sort.
### Pagination
`Criteria` for pagination is also implemented and you don't need to do it, but keep in mind that you still need to implement `CriteriaBuilder` that will make use of it and do actual pagination (this feature is under development).
Let's say you want to allow your end-user to change pages, but not number of items per page.
You can use this example code:
```php
$criteria = new ImmutablePaginationAdapter(
  new PaginationCriteria($page = 1, $itemsPerPage = 50)
);
// $criteria->setItemsPerPage(250);    <- use can try to change it
// $criteria->getItemsPerPage() = 50   <- but he can't actualy do it
// $criteria->getPage() = 1
```
Of course if you want to allow user to change number of items per page also you can skip the `ImmutablePaginationAdapter` and use just `PaginationCriteria`.

### Contributing
All ideas and pull requests are welcomed and appreciated :)
If you have any problem with usage don't hesitate to create an issue, we can figure your problem out together.

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
Author: Krzysztof Gzocha  
[![](https://img.shields.io/badge/Twitter-%40kgzocha-blue.svg)](https://twitter.com/kgzocha)
