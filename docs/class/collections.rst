============
Collections
============
The idea of having collections is very simple. We just want to keep our criteria and its builders in single place and
since array assignment in PHP always involves `value copying <http://php.net/manual/en/language.types.array.php>`_ it is
better to keep it in an object. Of course the object it self holds an array inside, but now we can pass our collection
by a reference, not by copying its value.

QueryCriteriaCollection
------------------------
In searcher library we have two collections responsible for holding a collection of ``QueryCriteria``.
They might have different ways of adding criteria,
but you can fetch all of the criteria it holds by simply calling ``getCriteria()`` method,
which will return an array of all the criteria.
If you want to extend capabilities of those classes, then you just need to implement your own class and make sure
that it will implement at least one of the interfaces:

- ``\KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollectionInterface`` for `Regular collection`_
- or ``\KGzocha\Searcher\QueryCriteria\Collection\NamedQueryCriteriaCollectionInterface`` for `Named collection`_.

Both of the collections are implementing ``getApplicableCriteria()`` method, which you might find useful, when
you will need only the criteria, which are applicable.
This method will return an array of criteria that are returning ``true`` in ``shouldBeApplied()`` method.

Regular collection
^^^^^^^^^^^^^^^^^^^
One ``\KGzocha\Searcher\QueryCriteria\Collection\QueryCriteriaCollection`` which just holds the criteria as values
of the array and it does not care about the keys. You can pass your criteria to it in two ways:

By constructor (I encourage you to use this method),
which will accept array or any object implementing ``\Traversable``, like:

.. code-block:: php

    $myArrayOfCriteria = [];
    $collection = new QueryCriteriaCollection($myArrayOfCriteria);

or by adding criteria one-by-one using ``addQueryCriteria()`` method, like:

.. code-block:: php

    $myCriteria = /** Whatever implementing QueryCriteriaInterface **/
    $collection = new QueryCriteriaCollection();

    $collection->addQueryCriteria($myCriteria);

Named collection
^^^^^^^^^^^^^^^^^
The other type of of collection is just extending the first one with possibility of adding a name to every
criteria. I've created this class to help to hydrate your criteria. It is easier to fetch some parameter
from the URI or POST data and map it's value to some model when those models have names.
You can find this class in ``\KGzocha\Searcher\QueryCriteria\Collection\NamedQueryCriteriaCollection``.
It has exactly the behaviour for unnamed criteria as the first collection,
so you can use methods described in `Regular collection`_ to add criteria, but it also allows you to do more.
You can add new criteria with their names also in two ways:

By using ``addNamedQueryCriteria()`` (which I encourage you to use), like:

.. code-block:: php

    $myCriteria = /** Whatever implementing QueryCriteriaInterface **/
    $collection = new NamedQueryCriteriaCollection();

    $collection->addNamedQueryCriteria('name-of-the-criteria', $myCriteria);

or by using magic fields (which I personally do not like), like this:

.. code-block:: php

    $myCriteria = /** Whatever implementing QueryCriteriaInterface **/
    $collection = new NamedQueryCriteriaCollection();

    $collection->nameOfTherCriteria = $myCriteria;

.. note::
    In second approach you need to be aware that you can not use character that PHP will see as a logic (like "-", "+", "=",..).

Regardless how you add your criteria you can fetch them via ``getNamedQueryCriteria()`` method, like:

.. code-block:: php

    $myCriteria = /** Whatever implementing QueryCriteriaInterface **/
    $collection = new NamedQueryCriteriaCollection();

    $result = $collection->getNamedQueryCriteria('name-of-the-criteria');

If there will be a criteria assigned to name ``name-of-the-criteria`` then it will be returned.
If not this method will return just null.


QueryCriteriaBuilderCollection
-------------------------------
Collection for ``QueryCriteriaBuilder`` is easier than for ``QueryCriteria``, because there is only one in the library.
There is no `Named collection`_ for ``QueryCriteriaBuilder``, but of course if you need it you can simply implement it.
You just need to use ``\KGzocha\Searcher\QueryCriteriaBuilder\Collection\QueryCriteriaBuilderCollectionInterface`` as interface.
You are able to add new builders in two ways:

By constructor (I encourage you to use this method) by passing an array or any ``\Traversable`` object with builders:

.. code-block:: php

    $builders = /** \Traversable|array of builders */
    $collection = new QueryCriteriaBuilderCollection($builders);

or by adding builders one by one with ``addQueryCriteriaBuilder()`` method, like:

.. code-block:: php

    $builder = /** Whatever implement QueryCriteriaBuilderInterface **/
    $collection = new QueryCriteriaBuilderCollection();

    $collection->addQueryCriteriaBuilder($builder);

Regardless the method you will use for adding a builders you can fetch them with ``getQueryCriteriaBuilders()``,
which will return an array of all the builders.

There is also one method that might be useful when you want to retrieve all the builders that are supporting specific ``SearchingContext``.
Let's look on example code:

.. code-block:: php

    $searchingContext = new QueryBuilderSearchingContext();     // Some Doctrine's SearchingContext
    $builder = /** Builder which support only QueryBuilderSearchingContext **/
    $collection = new QueryCriteriaBuilderCollection();
    $collection->addQueryCriteriaBuilder($builder);

    $builders = $collection->getQueryCriteriaBuildersForContext($searchingContext);

Now in ``$builders`` array we will have ``$builder`` object, because it is supporting specified SearchingContext.
