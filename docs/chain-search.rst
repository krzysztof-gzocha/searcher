================
Chain searching
================

What is it?
-------------
In this library chain searching is a searching process, which is divided into two or more sub-searches in the way,
that results from first sub-search are passed to next sub-search as a criteria. In the result of this process
developer will get collection of the results from all the sub-searches.

Each sub-search is represented by separate ``\KGzocha\Searcher\Chain\CellInterface`` instance, which encapsulates
searcher and transformer instances, which will be used to perform sub-search, so cells are independent from each
other and can hold searchers with different searching contexts. This will allow developers to perform first query
on one database, next one on different database and few more even on files - no problem.

Transformer
------------
Transformer is a service that is performing transformation from the results of some sub-search into
``CriteriaCollectionInterface``, that will be used in next sub-search. Optionally transformer can also implement
method ``skip()``, which if returns ``true`` will tell to skip this sub-search and chained search process move to the next one.

There is also one specific transformer ``\KGzocha\Searcher\Chain\EndTransformer``, which is basically null object,
which should be injected into last ``Cell`` to induce end of transformations.

Example
--------
First of all we will need at least two cells. Any lower number will trigger an exception - there is no point of
chaining only 1 (or zero) searchers, so let's assume we have two configured searchers, with different searching contexts.
Let's assume that we need to fetch users by some criteria with first query (and context) and then search for some statistics for them
in second search (and second context):

.. code:: php

    $userSearcher = $this->getFirstSearcher();          // Will search for users
    $statisticSearcher = $this->getSecondSearcher();    // Will search for statistics

and we have our first ``CriteriaCollection`` taken from the end-user:

.. code:: php

    $entryCriteria = new CriteriaCollection([/** criteria $userSearcher **/]);

We know that second searcher will expect for example criteria with array of user IDs, so we need to create
a transformer that will transform results from ``$userSearcher`` into ``CriteriaCollection``, that will be injected into
``$statisticSearcher``:

.. code:: php

    class Transformer implements \KGzocha\Searcher\Chain\TransformerInterface
    {
        /**
         * @param mixed $results
         */
        public function transform($results)
        {
            // Assuming that UserIdsCriteria will holds an array of user IDs
            $userIdsCriteria = new UserIdsCriteria(array_map(
                function ($user) {
                    return $user->getId();
                },
                $results
            ));

            return new CriteriaCollection($userIdsCriteria);
        }

        /**
         * We do not want to skip this results
         *
         * @param mixed $results
         * @return bool
         */
        public function skip($results)
        {
            return false;
        }
    }

In this transformer you can see, that we are getting all user IDs from the ``$results``, populating ``UserIdsCriteria``
with it and return ``CriteriaCollection`` with it. Pretty simple stuff.

Now we are ready and we can create instance of ``ChainSearch`` and populate it with our two cells, like this:

.. code:: php

    $cells = [
        new Cell(
            $userSearcher,
            new Transformer(),
            'users'            // Just an optional name
        ),
        new Cell(
            $statisticSearcher,
            new EndTransformer(),   // We don't want to go further
            'statistics'
        ),
    ];

    $chainSearch = new ChainSearch($cells);
    $results = $chainSearch->search($entryCriteria);

Now variable ``$results`` will hold ``ResultCollection`` with two elements:

.. code:: php

    $results->getResults() => [
        'users' => [/** results from $userSearcher **/],
        'statistics' => [/** results from $statisticSearcher **/],
    ]
