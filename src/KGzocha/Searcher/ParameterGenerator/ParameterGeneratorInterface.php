<?php
namespace KGzocha\Searcher\ParameterGenerator;

/**
 * This service can be used in order to assure unique parameter names
 * across all of the FilterImposers.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\ParameterGenerator
 */
interface ParameterGeneratorInterface
{
    /**
     * Method will return unique parameter name each time it will be called.
     * Example:
     * First call: $paramGenerator->getParameterName() -> 'searchParam1'
     * Second call: $paramGenerator->getParameterName() -> 'searchParam2'
     *
     * @return string
     */
    public function getParameterName();
}
