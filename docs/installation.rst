=============
Installation
=============

The best and simplest way to install this library is via `Composer <https://getcomposer.org/>`_.
To download and install Composer on your system please follow `these instructions <https://getcomposer.org/download/>`_.

If you have already installed composer on your machine, then you can install Searcher library by typing this
into your terminal:

.. code-block:: bash

    $ composer require krzysztof-gzocha/searcher

or if you have just downloaded composer.phar to the same folder as your application:

.. code-block:: bash

    $ php composer.phar require krzysztof-gzocha/searcher

After proper installation you should be able to find below text in your's composer.json file:

.. code-block:: json

    "require":{
        /** some libraries **/

        "krzysztof-gzocha/searcher": "^3.0.0"
    }

Installation on production
---------------------------
Searcher library has configured ``.gitattributes`` file, so whenever you will install it via command:

.. code-block:: bash

    $ composer install --prefer-dist

it will exclude files and folders that are not required in production environment (like docs/, tests/, etc).
You can read more about this command in `here <https://getcomposer.org/doc/03-cli.md#install>`_ and `here <https://www.reddit.com/r/PHP/comments/2jzp6k/i_dont_need_your_tests_in_my_production>`_.

Troubleshooting
----------------
Searcher has just one requirement (PHP language version >=7.0), but it has several development requirements,
which can require some PHP extensions, like ``ext-mongo``. If you do not have this extension installed on your system,
but you still want to test this library without installing it you can use flag ``--ignore-platform-reqs`` to tell composer
that it should not check for PHP extensions on your system. Whole installation command in this case will look like this:


.. code-block:: bash

    $ composer require krzysztof-gzocha/searcher --ingore-platform-reqs

You can read more about ``composer require`` on `composer pages <https://getcomposer.org/doc/03-cli.md#require>`_.
