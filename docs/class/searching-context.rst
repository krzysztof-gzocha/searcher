==================
Searching Context
==================

This service is used to provide user-defined *query builder* to criteria builders within searching process.
At the beginning it might not be obvious what *query builder* really is, but it's really simple:
it everything you want it to be and what can be used to actually build some interesting query!
You can use ``\Doctrine\ORM\QueryBuilder`` to build query for SQL databases or whatever that suits you.
The important part that you need to know as a developer is that you will have access to this from criteria builders
and criteria builders will use it to actually build the query.

You can even use searching context that will work with
Symfony's `Finder component <http://symfony.com/doc/current/components/finder.html>`_
**to search for FILES, not records/documents in database**!

There are a few already `implemented contexts <https://github.com/krzysztof-gzocha/searcher/tree/master/src/KGzocha/Searcher/Context>`_:

- Doctrine
    - ``\KGzocha\Searcher\Context\Doctrine\ODMBuilderSearchingContext`` for **ODM**
    - ``\KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext`` for **ORM**
- ``\KGzocha\Searcher\Context\Elastica\QuerySearchingContext`` for **ElasticSearch**
- ``\KGzocha\Searcher\Context\FinderSearchingContext`` for **files or directories**

If you can not find useful context, then you can always implement one - it's very easy.
Your's new searching context service just need to implement ``\KGzocha\Searcher\Context\SearchingContextInterface``.
Only two public methods are required: ``getQueryBuilder()`` for allowing criteria builders fetch yours *QueryBuilder*
and ``getResults()`` for allowing searcher to fetch the results after the query is constructed.

.. note::

    No one will tell you what ``getResults()`` should return, so it can be a number, array, collection or whatever.
    This is giving you great power, but with great power comes great responsibility. Please take care of your results
    and make sure you will always return what you really expect.

.. warning::

    Configuration of the query builder passed to SearchingContext should be done outside of the library, as it is not
    Searcher's responsibility to configure all query builders.

Symfony/Finder example
-----------------------

As an example this is source code of searching context with
`symfony/finder <http://symfony.com/doc/current/components/finder.html>`_ as query builder.
It will allow all criteria builders (that are supporting this context) to use Finder and construct very complex query!

.. code:: php

    use \KGzocha\Searcher\Context\SearchingContextInterface;
    use Symfony\Component\Finder\Finder;

    class FinderSearchingContext implements SearchingContextInterface
    {
        /**
        * @var Finder
        */
        private $finder;

        /**
        * @param $finder Finder
        */
        public function __construct(Finder $finder)
        {
            $this->finder = $finder;
        }

        /**
        * @return Finder
        */
        public function getQueryBuilder()
        {
            return $this->finder;
        }

        /**
        * @return Iterator
        */
        public function getResults()
        {
            // I assumed that you want Iterator as a result
            return $this->finder->getIterator();
        }
    }

Now you can simply instantiate it as follows:

.. code:: php

    $context = new FinderSearchingContext(new Finder());

That's it! Now we can use it with ``Searcher``.
