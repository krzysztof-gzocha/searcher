=================
Searcher
=================

What?
-----------------
*Searcher* is a library created in order to simplify construction of complex searching queries basing on passed models (aka *criteria*).
It's basic idea is to split each searching filter to separate class. Supported PHP versions: >=5.4, 7 and HHVM.

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
