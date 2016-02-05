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
Integration with Symfony is done in [SearcherBundle](https://github.com/krzysztof-gzocha/searcher-bundle)

### Idea
 - `FilterImposer` - will *impose* new conditions for single model
 - `FilterModel` - model that will be passed to `FilterImposer`. It will be populated from (for example) user input
 - `SearchingContext` - context of single search. This service holds something called `QueryBuilder`, but it can be anything that works for you. This is an abstraction layer between search and database. There is different context for Doctrine's ORM, ODM*, FOS Elastica* and so on. (* to be implemented). This service should know how to fetch results from constructed query,
 - `Searcher` - holds collection of `FilterImposer`'s and will pass `FilterModel`'s to apropriate `FilterImposer`s.

### Contributing
All ideas and pull requests are welcomed and appreciated :)

### Development
Command to run test: `bin/phing`
