# Searcher [![Build Status](https://travis-ci.org/krzysztof-gzocha/searcher.svg?branch=master)](https://travis-ci.org/krzysztof-gzocha/searcher)

### What is that?
*Searcher* is a library created in order to simplify construction of complex searching queries basing on passed models.
It's basic idea is to split each searching *filter* to separate class.
Supported PHP versions: >=5.4, 7 and HHVM.

### Why?
Did you ever seen code responsible for searching some entities basing on many different criteria? It can be quite a mess!
Imagine that you have a form with 20 fields and all of them have their impact on searching conditions.
It's maybe not a great idea to pass whole form to some service at let it parse everything in one place. 
Thanks to this library you can split the responsibility of imposing conditions to several smaller classes. One class per model (field). In this way in one `FilterImposer` you only care for one `FilterModel`, which makes it a lot more readable.
You can later use exactly the same `FilterModel` for different search, with different `FilterImposer` and different `SearchingContext` which will use different database.

### Installation
You can install the library via composer by typing:
```
composer require krzysztof-gzocha/searcher
```

### Integration
Integration with Symfony is done in **[SearcherBundle](https://github.com/krzysztof-gzocha/searcher-bundle)**

### Idea
 - `FilterImposer` - will *impose* new conditions for single model
 - `FilterModel` - model that will be passed to `FilterImposer`. It will be populated from (for example) user input
 - `SearchingContext` - context of single search. This service holds something called `QueryBuilder`, but it can be anything that works for you. This is an abstraction layer between search and database. There is different context for Doctrine's ORM, ODM, Elastica and so on. This service should know how to fetch results from constructed query,
 - `Searcher` - holds collection of `FilterImposer`'s and will pass `FilterModel`'s to apropriate `FilterImposer`s.

### Example
Let's say we want to search for **people** whose **age** is in some filterd range.
In this example we will use Doctrine's QueryBuilder, so we will use `QueryBuilderSearchingContext` and will specify in `FilterImposer` that it should interact only with `Doctrine\ORM\QueryBuilder`, but we do **not** have to use only Doctrine.

First of all we would need to create `AgeRangeFilterModel` - the class that will holds values of minimal and maximal age.
```php
class AgeRangeFilterModel implements FilterModelInterface
{
    private $minimalAge;
    private $maximalAge;

    /**
    * Only required method.
    * If will return true, then it will be passed to some of the FilterImposer(s)
    */
    public function isImposed()
    {
        return null !== $this->minimalAge && null !== $this->maximalAge;
    }

    // getters, setters, what ever
}
```
In second step we would like to specify conditions that should be imposed for this model.
That's why we would need to create `AgeRangeFilterImposer`
```php
class AgeRangeFilterImposer implements FilterImposerInterface
{
    public function imposeFilter(
        FilterModelInterface $filterModel,
        SearchingContextInterface $searchingContext
    ) {
        $searchingContext
            ->getQueryBuilder()
            ->andWhere('e.age >= :minimalAge')
            ->andWhere('e.age <= :maximalAge')
            ->setParameter('minimalAge', $filterModel->getMinimalAge())
            ->setParameter('maximalAge', $filterModel->getMaximalAge());
    }

    public function supportsModel(
        FilterModelInterface $filterModel
    ) {
        // No need to check isImposed(). Searcher will check it
        return $filterModel instanceof AgeRangeFilterModel;
    }

    /**
    * You can skip this method if you will extend from QueryBuilderFilterImposer.
    */
    public function supportsSearchingContext(
        SearchingContextInterface $searchingContext
    ) {
        return $searchingContext instanceof \Doctrine\ORM\QueryBuilder;
    }
}
```
In next steps we would need to create collections for both: models and imposers.
```php
$imposers = new FilterImposerCollection();

$imposers->addFilterImposer(new AgeRangeFilterImposer());
$imposers->addFilterImposer(/** rest of filter imposers */);
```
```php
$ageRangeModel = new AgeRangeModel();

// We have to populate the model before searching
$ageRangeModel->setMinimalAge(23);
$ageRangeModel->setMaximalAge(29);

$models = new FilterModelCollection();
$models->addFilterModel($ageRangeModel);
$models->addFilterModel(/** rest of models */);
```
Now we would like to create our `SearchingContext` and populate it with QueryBuilder taken from Doctrine ORM.
```php
$context  = new QueryBuilderSearchingContext($queryBuilder);

$searcher = new Searcher($imposers, $context);
$searcher->results($models); // Yay, we have our results!
```

### Contributing
All ideas and pull requests are welcomed and appreciated :)

### Development
Command to run test: `bin/phing`

### Thanks to
In alphabetical order
- https://github.com/chkris 
- https://github.com/pawelhertman 
- https://github.com/ustrugany 
- https://github.com/wojciech-olszewski
