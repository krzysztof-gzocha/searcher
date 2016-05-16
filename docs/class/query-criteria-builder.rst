=======================
Query criteria builder
=======================

Idea
-----
In searcher library ``CriteriaBuilder`` class is used to actually build a *part* of
the searching query for some *abstract database*. To do so it requires a specific ``Criteria`` and some *abstract query builder*.
Query criteria builders can work with multiple other ``SearchingContext``,
which can work with multiple libraries and databases like:

- Doctrine ORM for MySQL, MariaDB, Postgres
- Doctrine ODM for MongoDB
- ruflin/elastica for ElasticSearch
- and anything else that will came to your mind

Only classes that are implementing ``\KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface`` can be used
as a criteria builders. This means that builders need to implement 3 methods:

- ``buildCriteria()`` which will setup the conditions on ``SearchingContext`` with values taken from ``Criteria``,
- ``allowsCriteria()`` which determines if this builders can handle specific ``Criteria``,
- ``supportsSearchingContext()`` which obviously determines if this builder can be used with this specific ``SearchingContext``.


Doctrine example
-----------------
Describing ``Criteria`` we've used example of searching for people, lets create a builder for this example using Doctrine's ORM.
In order to do it we will need to create a builder which allows our *SpecificAgeCriteria* and
will support Doctrine's searching context which is ``\KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext``.

.. code-block:: php

    use \KGzocha\Searcher\CriteriaBuilder\Doctrine\AbstractORMCriteriaBuilder;
    use \KGzocha\Searcher\Criteria\CriteriaInterface;
    use \KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext;
    use \KGzocha\Searcher\Context\SearchingContextInterface;

    class SpecificAgeCriteriaBuilder extends AbstractORMCriteriaBuilder
    {
        public function allowsCriteria(CriteriaInterface $criteria)
        {
            return $criteria instanceof SpecificAgeCriteria;
        }

        /**
        * @param SpecificAgeCriteria $criteria
        * @param QueryBuilderSearchingContext $searchingContext
        */
        public function buildCriteria(
            CriteriaInterface $criteria,
            SearchingContextInterface $searchingContext
        ) {
            $searchingContext
                ->getQueryBuilder()
                ->andWhere('p.age = :age')  // use andWhere, not where
                ->setParameter(
                    'age',
                    $criteria->getAge()
                );
        }
    }

That's it! You can see new classes are used in here like ``AbstractORMCriteriaBuilder`` or ``QueryBuilderSearchingContext``,
but don't worry those are very simple classes which are already implemented and should only help you to start using this library.

- ``AbstractORMCriteriaBuilder`` - abstract CriteriaBuilder class which will allow only ``QueryBuilderSearchingContext`` to be used (You can see there is no ``supportSearchingContext`` method).
- ``QueryBuilderSearchingContext`` - searching context which will work only with Doctrine's ORM QueryBuilder

Whats the most important for us are the methods ``allowsCriteria()`` and of course ``buildCriteria()``.
In ``allowsCriteria()`` we have to just specify that we want only care about *SpecificAgeCriteria*.
The actual building of the query is taking place on ``buildCriteria()``. What is going on there?

- We are fetching Doctrine's QueryBuilder by ``$searchingContext->getQueryBuilder()``,
- we are adding *and* condition and setting parameter,
- we are specifying value of this parameter with value taken from ``Criteria``.

The most **important part** in here is to use **andWhere** instead of **where**, why?
Because there might be another ``CriteriaBuilder`` before and using **where** would might have overwrite it's logic.
It's really important for you to always think about single ``CriteriaBuilder`` as a part of complete query.
You should always work only on your part - you don't want to mess up logic from different ``CriteriaBuilder``.

Too long, didn't read
----------------------
**What do you need to know about CriteriaBuilder:**

1. It can be **any** class implementing ``CriteriaBuilderInterface``
#. Build query using SearchingContext's QueryBuilder and values from Criteria
#. You should be careful with constructing queries and not overwrite logic from different builder
#. Always think about it like a single part from a massive and complex query
