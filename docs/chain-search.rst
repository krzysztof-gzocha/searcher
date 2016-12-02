================
Chain searching
================

What is it?
-------------
Chain searching is a searching process which is divided into two or more sub-searches, resulting in the first 
sub-search being passed to next as a criteria, and so on. The end result of this process is an aggregated collection 
of the results from all the sub-searches in the chain.

Each sub-search is represented by separate ``\KGzocha\Searcher\Chain\CellInterface`` instance, which encapsulates
the searcher and transformer instances, which internally are used to perform sub-searches. Therefore, cells are independent
from each other and can hold searchers with different searching contexts. This allows one to perform a first query
on one database, followed by another one on a different database and few more even on files, without problems.

Transformer
------------
Transformer is a service that performs the transformation from the results of some sub-search into a
``CriteriaCollectionInterface``, that will then be used in the next sub-search. Optionally, a transformer can also implement
the ``skip()`` method, which returns a boolean that, if ``true``, will tell the chain to skip this sub-search and move to
the next one.

There is also one specific transformer ``\KGzocha\Searcher\Chain\EndTransformer``, which is basically null object that should be injected into the last ``Cell`` to force the end of the transformations.

Example
--------
First of all we need at least two cells. Any lower number will trigger an exception - there is no point of
chaining only 1 (or zero) searchers, so let's assume we have two configured searchers, with different searching contexts.
Let's also assume that we need to fetch users by some criteria with the first query (and context), and then search for
some statistics for them in the second query (and second context):

.. code:: php

    $userSearcher = $this->getFirstSearcher();          // Will search for users
    $statisticSearcher = $this->getSecondSearcher();    // Will search for statistics

and we have our first ``CriteriaCollection`` taken from the end-user:

.. code:: php

    $entryCriteria = new CriteriaCollection([/** criteria $userSearcher **/]);

We know that the second searcher will expect, for example, a criteria with an array of user ids, so we need to create
a transformer that will transform the results from ``$userSearcher`` into a ``CriteriaCollection``, that will then be
injected into the ``$statisticSearcher``:

.. code:: php

    class Transformer implements \KGzocha\Searcher\Chain\TransformerInterface
    {
        /**
         * @param mixed $results
         */
        public function transform($results, CriteriaCollectionInterface $criteria): CriteriaCollectionInterface
        {
            // Assuming that UserIdsCriteria will holds an array of user IDs
            $userIdsCriteria = new UserIdsCriteria(array_map(
                function ($user) {
                    return $user->getId();
                },
                $results
            ));

            // We can use some criteria from previous search, but in this scenario we do not need them.

            return new CriteriaCollection($userIdsCriteria);
        }

        /**
         * We do not want to skip this results
         *
         * @param mixed $results
         * @return bool
         */
        public function skip($results): bool
        {
            return false;
        }
    }

In this transformer you can see that we are getting all user ids from the ``$results``, populating ``UserIdsCriteria``
with those and returning a ``CriteriaCollection``. Pretty simple stuff.

Now we are ready and we can create an instance of ``ChainSearch`` and populate it with our two cells, like this:

.. code:: php

    $cells = new CellCollection([

        // Optionally you can specify a name for ease of fetching sub-results
        'users' => new Cell(
            $userSearcher,
            new Transformer(),
        ),

        'statistics' => new Cell(
            $statisticSearcher,
            new EndTransformer(),   // We don't want to go further
        ),
    ]);

    $chainSearch = new ChainSearch($cells);
    $results = $chainSearch->search($entryCriteria);

Now, the variable ``$results`` will hold a ``ResultCollection`` with two elements:

.. code:: php

    $results->getResults() => [
        'users' => [/** results from $userSearcher **/],
        'statistics' => [/** results from $statisticSearcher **/],
    ]

.. warning::

    When trying to use CellCollection will less than 2 elements InvalidArgumentException will be thrown, because
    there is no sense in using chain search with just 1 cell.
