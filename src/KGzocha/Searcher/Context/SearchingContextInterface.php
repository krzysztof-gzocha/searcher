<?php
namespace KGzocha\Searcher\Context;

/**
 * @author Krzysztof Gzocha
 * @package KGzocha\Searcher\Context
 */
interface SearchingContextInterface
{
    /**
     * @return mixed
     */
    public function getQueryBuilder();

    /**
     * This method will be used to get results from provided query builder.
     * This method have to be implemented in specific SearchingContext's that
     * will extend this class.
     * For memory efficient please do not use simple array to return bigger results.
     * @return mixed
     */
    public function getResults();
}
