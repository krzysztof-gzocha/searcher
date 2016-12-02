===============
Criteria
===============

Idea
-----
In simplest words ``Criteria`` classes will hold all the parameters and their values that can be used
with ``CriteriaBuilder`` class(s) in searching process. You have to be aware that ``Criteria`` can be used
with multiple ``CriteriaBuilder``, which means that it can be used for searches in MySQL, MongoDB, SQLite
or whatever context you will use (I will describe contexts later) and that's why we we are not talking about any specific context.
Instead we will use *abstract database*
Of course you can use multiple ``Criteria`` within single searching process.
Any class that implements ``\KGzocha\Searcher\Criteria\CriteriaInterface`` can be used as ``Criteria``.
There is only one method inside this interface that is required to be implemented and it is ``shouldBeApplied()``.
The name of the method should speak for it self - if it will return true then the criteria will be used in searching process.
Of course if there will be at least one ``CriteriaBuilder`` that will handle it, but I will describe builders later on.


Example
--------
Single query criteria can have zero or more fields that can be included in searching process.
Let's say for example that we want to search in our *abstract database* for a particular person by his specific age.
In order to to do you can create very simple class:

.. code-block:: php

    use \KGzocha\Searcher\Criteria\CriteriaInterface;

    class SpecificAgeCriteria implements CriteriaInterface
    {
        private $age;

        public function getAge(): int
        {
            return $this->age;
        }

        public function setAge(int $age)
        {
            $this->age = $age;
        }

        /**
        * Only required method.
        * If will return true, then it will be passed to some of the CriteriaBuilder(s)
        */
        public function shouldBeApplied(): bool
        {
            return null !== $this->age;
        }
    }

As you can see this is very small and simple class holding just one field, its getter and setter and ``shouldBeApplied()`` method.
In this example we want *age* criteria to be used only if age field inside is specified,
so we need to check if ``null !== $this->age`` inside ``shouldBeApplied()``.

Multiple fields example
------------------------

Ok, we have criteria for one fields, but what if having more makes more sense? Well, nothing is gonna stop you to do it!
Lets assume that you still want to query your *abstract database* of people by theirs age, but you do not want specific age, but
rather age range. Nothing is simpler! We just need to create criteria with minimum and maximum age, so let's do that!
We are still *filtering* people by 1 *filter*, so keeping two fields in single ``Criteria`` makes sense, but
you should keep your ``Criteria`` as small as possible. It should be readable and naming used inside should be obvious.

.. code-block:: php

    use \KGzocha\Searcher\Criteria\CriteriaInterface;

    class AgeRangeCriteria implements CriteriaInterface
    {
        private $minimumAge;
        private $maximumAge;

        public function getMinimumAge(): int
        {
            return $this->minimumAge;
        }

        public function setMinimumAge(int $age)
        {
            $this->minimumAge = $age;
        }

        public function getMaximumAge(): int
        {
            return $this->maximumAge;
        }

        public function setMaximumAge(int $age)
        {
            $this->maximumAge = $age;
        }

        /**
        * Please notice that there is OR condition inside
        */
        public function shouldBeApplied(): bool
        {
            return null !== $this->minimumAge || null !== $this->maximumAge;
        }
    }

Now you can specify both minimum and maximum age of people that you want to search for.
Please notice that in this example in ``shouldBeApplied()`` method I've used **or** condition, so this criteria
will be applied even if you will specify at least one of the fields.
If there would be **and** condition then this criteria would be applied only if both of the fields would be fulfilled.

Implemented criteria
---------------------
You can find and use already implemented Criteria in `here <https://github.com/krzysztof-gzocha/searcher/tree/master/src/KGzocha/Searcher/Criteria>`_.
You will find there query criteria for:

- Coordinates
- DateTime
- DateTimeRange
- Integer
- IntegerRange
- Number
- OrderBy (with ``MappedOrderByAdapter``)
- Pagination (with ``ImmutablePaginationAdapter``)
- Text
- AlwaysAppliedCriteria

Always applied criteria
------------------------
In some cases you might find ``AlwaysAppliedCriteria`` useful, as you might use it to trigger some ``CriteriaBuilder``,
which will add some very important constraints to the ``QueryBuilder``. For example you might want to use it to
force searcher to return entities/rows/files/documents only with specified status. In such scenario you can add
``AlwaysAppliedCriteria`` directly to the ``CriteriaCollection`` and add ``CriteriaBuilder`` for it - builder will
always be triggered, which will make impossible for end-user to change this behaviour.

Order adapter
--------------
Imagine situation in which you have constructed query using Doctrine's ORM as query builder.
Now you want to allow user to pick how he would like to get the results ordered, but in the way
that will tell him nothing about the query it self. For example you would like to order your query
by parameter ``p.id``, but you want user to see ``peopleId`` instead. To do so you can use
``\KGzocha\Searcher\Criteria\Adapter\MappedOrderByAdapter`` and following code snippet:

.. code:: php

    use \KGzocha\Searcher\Criteria\Adapter\MappedOrderByAdapter;

    $mappedFields = [
        'peopleId' => 'p.id',
        '<order by field>' => '<mapped field>',
        /** rest of the mapping **/
    ];

    $criteria = new MappedOrderByAdapter(
        new OrderByCriteria('peopleId'),    // hydrated OrderBy criteria
        $mappedFields
    );

    $criteria->getMappedOrderBy() == 'p.id'
    $criteria->getOrderBy() == 'peopleId'

In this way we are also ensuring that only values specified in ``$mappedFields`` will hit criteria builders.

.. warning::

    If OrderByCriteria will be hydrated with value that is not in the mapped fields,
    then ``getMappedOrderBy()`` will return null and ``shouldBeApplied()`` will return false

Pagination adapter
-------------------
Often you want empower user to paginate your result and to do so you can use already
implemented ``PaginationCriteria``, but sometimes you would like to forbid changing of number of items per page.
This feature is also already implemented and it's very easy to use.

.. code:: php

    use \KGzocha\Searcher\Criteria\Adapter\ImmutablePaginationAdapter'

    $criteria = new ImmutablePaginationAdapter(
        new PaginationCriteria($page = 1, $itemsPerPage = 50)
    );

With criteria constructed as above user can change only the page. There is no possibility to change number
of items per page.


Too long, didn't read
----------------------
**What do you need to know about Criteria:**

1. It can be **any** class implementing ``CriteriaInterface``
#. Holds parameters and values that will be used in searching process
#. Implementation of ``shouldBeApplied`` can change searching behaviour
#. Can be used with multiple ``CriteriaBuilder``
