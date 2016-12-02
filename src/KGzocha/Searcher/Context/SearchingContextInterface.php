<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Context;

/**
 * This is a layer of abstraction between searcher and searching engines and ORMs.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
interface SearchingContextInterface
{
    /**
     * This method should return any service that CriteriaBuilders can invoke
     * in order to do actual Query changes.
     *
     * @return mixed
     */
    public function getQueryBuilder();

    /**
     * This method will be used to get results from provided query builder.
     * This method have to be implemented in specific SearchingContext's that
     * will extend this class.
     * For memory efficient please do not use simple array to return bigger results.
     *
     * @return mixed
     */
    public function getResults();
}
