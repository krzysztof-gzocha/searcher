=========================
Integration with Symfony
=========================

Currently searcher library can be easily connected to any application written in
`Symfony framework <http://symfony.com/>`_ version 2 or higher. This documentation will guide you
through installation and usage of the library inside Symfony application.
Knowledge of the library itself is **strongly recommended** before starting to integrate with any framework.

Integration is done through the separate *bundle* - **SearcherBundle** - that can be easily added to existing app.
You can find it in:

- GitHub: https://github.com/krzysztof-gzocha/searcher-bundle
- Packagist: https://packagist.org/packages/krzysztof-gzocha/searcher-bundle

Installation
-------------

The easiest way to install this bundle is through usage of composer - the same way as the library.
In order to do it you need just to type in your favorite terminal:

.. code:: bash

    $ composer require krzysztof-gzocha/searcher-bundle

.. note::

    SearcherBundle already has specified searcher library as requirement, so you do not need to require library itself.
    Bundle will be enough.

Next step is to let Symfony know about it by adding it to registered bundles in ``AppKernel.php`` file like this:

.. code:: php

    public function registerBundles()
    {
      $bundles = array(
        /** Your bundles **/
        new \KGzocha\Bundle\SearcherBundle\KGzochaSearcherBundle(),
      );
      /** rest of the code  **/
    }

Now Symfony will be aware of searcher, but if we want to fully use it we would need to configure it, which is also very simple
if you know how the library works.

Basic configuration
--------------------

I recommend to start with creation of new file, called ``searcher.yml`` in which we will put all our searcher specific configuration.
Then we should import this file in global ``config.yml`` file by adding this code at the top of it:

.. code:: yaml

    imports:
        - { resource: searcher.yml }

.. note::

    Of course you do not need to create seperate file for searcher configuration. I just find this way prettier, but
    you can use whatever way that is better for you.

Now in ``searcher.yml`` we can start to develop our basic configuration. Configuration below is basic working example
that we will describe in details.

.. code:: yaml

    k_gzocha_searcher:
      contexts:
        people:
          context:
            service: your_searching_context_service_id

          criteria:
            - { class: \AgeRangeCriteria, name: age_range}
            - { service: some_service_id, name: other_criteria }

          builders:
            - { class: \AgeRangeCriteriaBuilder, name: age_range }
            - { service: other_service_id, name: my_criteria_builder }

First line ``k_gzocha_searcher`` is just a statement used to specify that everything below is the actual config of searcher.
Fun starts after second line ``contexts``, which describes a fact that below this statement SearcherContexts are specified.
Now, line ``people`` doesn't sound like connected to the library or bundle and it shouldn't, because it is a name
of the searching context, that we will use.
In next point we have to specify name of the service that implements SearchingContextInterface.
Unfortunately you have to create this service on your own and bundle will not help you with that... yet.
Going further.. In next step we need to specify our criteria, that might be used during searching process.
In this example we have two of them: ``age_range`` which is a simple class ``\AgeRangeCriteria`` and ``other_criteria``
which is already existing service with a name ``some_service_id``.

.. warning::

    Please remember that we are describing criteria with their class name or service name - never both.
    If both parameter will be provided, then class parameter will be omitted. Service parameter have higher priority.
    This rule is the same for every configuration point in this bundle.

In the last step we are configuring CriteriaBuilders that might be used by searcher and again we have two of them:
``age_range`` described as a class ``\AgeRangeCriteriaBuilder`` and ``my_criteria_builder`` described as already existing
service with a name ``other_service_id``.

Configuration created in this way will create services for every searcher class.
Those services will be accessible for you. Here is a list of them:

- Searcher: ``k_gzocha_searcher.people.searcher``
- Context: ``k_gzocha_searcher.people.context``
- Criteria "age_range": ``k_gzocha_searcher.people.criteria.age_range``
- Criteria "other_criteria": ``k_gzocha_searcher.people.criteria.other_criteria``
- Builder "age_range": ``k_gzocha_searcher.people.builder.age_range``
- Builder "my_criteria_builder": ``k_gzocha_searcher.people.builder.my_criteria_builder``
- Criteria collection: ``k_gzocha_searcher.people.criteria_collection`` (Named collection is used by default)
- Builder collection: ``k_gzocha_searcher.people.builder_collection``

You can found complete configuration reference in `here <https://github.com/krzysztof-gzocha/searcher-bundle/blob/master/src/KGzocha/Bundle/SearcherBundle/configReference.yml>`_.

Example searching context definition
-------------------------------------

Below code will show an example definition of ``QueryBuilderSearchingContext`` for Doctrine ORM.
The code is assuming that service ``entity.repository`` actually exists and you want to use alias ``alias`` for it.

.. code:: yaml

    services:
       project_doctor.entity.query_builder:
          class: Doctrine\ORM\QueryBuilder
          factory: ['@entity.repository', 'createQueryBuilder']
          arguments:
            - 'alias'

       project_doctor.entity.searching_context:
          class: 'KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext'
          arguments:
            - '@project_doctor.entity.query_builder'

With definition like that we can now use it in SearcherBundle configuration as follows:

.. code:: yaml

    k_gzocha_searcher:
      contexts:
        people:
          context:
            service: project_doctor.entity.searching_context

Hydration
----------

In pure searcher library there is nothing mentioned about how you can fetch values from user of your application and
pass them to corresponding criteria, but in Symfony we have very powerful tool to do it properly - forms!
Let's assume we have our ``\AgeRangeCriteria`` configured with name ``age_range`` and let's assume that it
has two fields ``minimalAge`` and ``maximalAge``. Now we can build a form, that will help us hydrate this criteria:

.. code:: php

    use KGzocha\Bundle\SearcherBundle\Form\SearchForm;

    class MySearchForm extends SearchForm
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('minimalAge', 'integer', [
                    'property_path' => $this->getPath('ageRange', 'minimalAge'),
                ])
                ->add('maximalAge', 'integer', [
                    'property_path' => $this->getPath('ageRange', 'maximalAge'),
                ])
                /** and any other fields.. **/
                ->add('<parameter name in request>', '<form type>', [
                    'property_path' => $this->getPath(
                        '<criteria name from config>',
                        '<criteria field name inside the class>'
                    ),
                ]);
        }
    }

Example action
---------------

Assuming that we have installed bundle, configured searcher and created form we can perform our first search by creating
simple action inside a controller:

.. code:: php

    public function searchAction(Request $request)
    {
        $form = $this->createForm(
            new MySearchForm(),
            $this->get('k_gzocha_searcher.people.criteria_collection')
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $searcher = $this->get('k_gzocha_searcher.people.searcher');
            $results = $searcher->search($form->getData());
            // Yay, we have our results!
        }

        /** rest of the code **/
    }


.. warning::

    By default Searcher is wrapped with WrappedResultsSearcher, so results will be actually an instance of ResultCollection.
    If you would like to have pure Searcher then you have to specify searcher.wrapper_class in the config as null
    or create searcher service yourself and specify searcher.service.
