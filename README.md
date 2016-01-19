# Searcher [![Build Status](https://travis-ci.org/krzysztof-gzocha/searcher.svg?branch=master)](https://travis-ci.org/krzysztof-gzocha/searcher)

### What is that?
*Searcher* is a framework and database agnostic library, created in order to simplify construction of complex searching queries basing on passed models.
*Searcher* is supporting all PHP versions starting from >=5.4, including PHP 7 and HHVM.

### Basic idea
`FilterImposerInterface` - will *impose* new conditions for single model,

`FilterModelInterface` - model that will be passed to `FilterImposerInterface`. This will be created from (for example) user input,

`SearchingContextInterface` - context of single search. This service holds something called `QueryBuilder`, but it can be anything that works for you.
This is an abstraction layer between search and database. There is different context for Doctrine's ORM, ODM*, FOS Elastica* and so on. (* to be implemented). This service should know how to fetch results from constructed query,

`SearcherInterface` - holds collection of `FilterImposer`'s and will pass `FilterModel`'s to corresponding `FilterImposer`s.

---
### Development
Command to run test: `bin/phing run-tests`
