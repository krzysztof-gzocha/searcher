=========
Searcher
=========

Last step for searching process is to instantiate searcher service, perform searching and fetch the results.
To properly instantiate ``\KGzocha\Searcher\Searcher`` class you need searching context and collection of criteria builders

.. code:: php

    use \KGzocha\Searcher\Searcher;
    use \KGzocha\Searcher\Context\FinderSearchingContext;
    use \KGzocha\Searcher\CriteriaBuilder\Collection\CriteriaBuilderCollection;
    use \Symfony\Component\Finder\Finder;

    // Just example context and builder collection
    $context = new FinderSearchingContext(new Finder());
    $criteriaBuilders = new CriteriaBuilderCollection();

    $searcher = new Searcher($criteriaBuilders, $context);

Of course above code is just an example with usage of Symfony's `Finder <https://symfony.com/doc/current/components/finder.html>`_ component,
but you can use different context and collection. Only requirement is that both of them needs to implement proper interfaces.

Fetch results
--------------

When ``Searcher`` service is ready you can ask for results by calling ``search()`` method with collection of criteria as parameter.
This method will return results provided by ``SearchingContextInterface::getResults()``, so if your context will return
an integer, searcher will also return integer.

.. code:: php

    use \KGzocha\Searcher\Criteria\Collection\CriteriaCollection;

    $results = $searcher->search(new CriteriaCollection());    // just dummy, empty collection

.. warning::

    Please, pay attention what is returned from searching context.

If you are afraid that your SearchingContext and QueryBuilder might return ``null`` when you are expecting ``array`` or
``\Traversable`` object, then you can use a wrapper that will handle this kind of situations for you.
Using ``\KGzocha\Searcher\WrappedResultsSearcher`` will always return ``\KGzocha\Searcher\Result\ResultCollection`` on each ``search()``
and ``ResultCollection`` will accept the results only if they are traversable,
so if your context will return ``null`` the collection will be just empty. Rest of the Searcher behaviour will remain unchanged.
Code snippet below is showing how to use it:

.. code:: php

    use \KGzocha\Searcher\Searcher;
    use \KGzocha\Searcher\WrappedResultsSearcher;
    use \KGzocha\Searcher\Result\ResultCollection;

    $searcher = new WrappedResultsSearcher(new Searcher($builders, $context));

    /** @var $results ResultCollection **/
    $results = $searcher->search($criteriaCollection);

    // Even if $context->getResults() will return null it will not break
    foreach ($results as $result) {
        var_dump($result);
    }

    // This will also work
    foreach ($results->getResults() as $result) {
        var_dump($result);
    }

That's all about ``Searcher`` service. Check out examples and framework integrations for more.
