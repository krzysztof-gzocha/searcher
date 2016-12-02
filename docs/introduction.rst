=================
Searcher
=================

.. image:: https://camo.githubusercontent.com/03659f3fcddeaec49aa2f494c1d4aff0ec9cbd36/687474703a2f2f7777772e636c6b65722e636f6d2f636c6970617274732f612f632f612f382f31313934393936353638313938333637303238396b63616368656772696e642e7376672e7468756d622e706e67
    :align: left

What?
-----------------
*Searcher* is a framework-agnostic search query builder.
Search queries are written using Criterias and can be run against MySQL, MongoDB or even files.
**Latest version is supporting only PHP 7.**
You can find searcher in two most important places:

- GitHub repository: https://github.com/krzysztof-gzocha/searcher
- Packagist: https://packagist.org/packages/krzysztof-gzocha/searcher


Why?
----------
Did you ever seen code responsible for searching some entities basing on many different criteria?
It can be quite a mess! Imagine that you have a form with 20 fields and all of them have their impact on searching conditions.
It's maybe not a great idea to pass whole form to some service at let it parse everything in one place.

How?
-----
Thanks to this library you can split the responsibility of building query criteria to several smaller classes.
One class per filter. One **CriteriaBuilder** per **Criteria**.
In this way inside **CriteriaBuilder** you care only for one **Criteria**, which makes it a lot more readable.
You can later use exactly the same **Criteria** for different search,
with different **CriteriaBuilder** and even different **SearchingContext** which can use even different database.
