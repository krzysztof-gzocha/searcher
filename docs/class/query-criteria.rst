===============
Query criteria
===============

Idea
-----
In simplest words ``QueryCriteria`` classes will hold all the parameters and their values that can be used
with ``QueryCriteriaBuilder`` class(s) in searching process. You have to be aware that ``QueryCriteria`` can be used
with multiple ``QueryCriteriaBuilder``, which means that it can be used for searches in MySQL, MongoDB, SQLite
or whatever context you will use (I will describe contexts later) and that's why we we are not talking about any specific context.
Instead we will use *abstract database*
Of course you can use multiple ``QueryCriteria`` within single searching process.
Any class that implements ``\KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface`` can be used as ``QueryCriteria``.
There is only one method inside this interface that is required to be implemented and it is ``shouldBeApplied()``.
The name of the method should speak for it self - if it will return true then the criteria will be used in searching process.
Of course if there will be at least one ``QueryCriteriaBuilder`` that will handle it, but I will describe builders later on.


Example
--------
Single query criteria can have zero or more fields that can be included in searching process.
Let's say for example that we want to search in our *abstract database* for a particular person by his specific age.
In order to to do you can create very simple class:

.. code-block:: php

    use \KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

    class SpecificAgeQueryCriteria implements QueryCriteriaInterface
    {
        private $age;

        public function getAge()
        {
            return $this->age;
        }

        public function setAge($age)
        {
            $this->age = $age;
        }

        /**
        * Only required method.
        * If will return true, then it will be passed to some of the QueryCriteriaBuilder(s)
        */
        public function shouldBeApplied()
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
We are still *filtering* people by 1 *filter*, so keeping two fields in single ``QueryCriteria`` makes sense, but
you should keep your ``QueryCriteria`` as small as possible. It should be readable and naming used inside should be obvious.

.. code-block:: php

    use \KGzocha\Searcher\QueryCriteria\QueryCriteriaInterface;

    class AgeRangeQueryCriteria implements QueryCriteriaInterface
    {
        private $minimumAge;
        private $maximumAge;

        public function getMinimumAge()
        {
            return $this->minimumAge;
        }

        public function setMinimumAge($age)
        {
            $this->minimumAge = $age;
        }

        public function getMaximumAge()
        {
            return $this->maximumAge;
        }

        public function setMaximumAge($age)
        {
            $this->maximumAge = $age;
        }

        /**
        * Please notice that there is OR condition inside
        */
        public function shouldBeApplied()
        {
            return null !== $this->minimumAge || null !== $this->maximumAge;
        }
    }

Now you can specify both minimum and maximum age of people that you want to search for.
Please notice that in this example in ``shouldBeApplied()`` method I've used **or** condition, so this criteria
will be applied even if you will specify at least one of the fields.
If there would be **and** condition then this criteria would be applied only if both of the fields would be fulfilled.

Implemented criteria
-----------------------------
You can find and use already implemented QueryCriteria in `here <https://github.com/krzysztof-gzocha/searcher/tree/master/src/KGzocha/Searcher/QueryCriteria>`_.
You will find there query criteria for:

- Coordinates
- DateTime
- DateTimeRange
- Integer
- IntegerRange
- Number
- OrderBy
- Pagination
- Text


Too long, didn't read
--------------------
**What do you need to know about QueryCriteria:**

1. It can be **any** class implementing ``QueryCriteriaInterface``
#. Holds parameters and values that will be used in searching process
#. Implementation of ``shouldBeApplied`` can change searching behaviour
#. Can be used with multiple ``QueryCriteriaBuilder``
