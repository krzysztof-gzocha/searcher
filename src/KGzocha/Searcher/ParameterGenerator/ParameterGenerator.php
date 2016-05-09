<?php

namespace KGzocha\Searcher\ParameterGenerator;

/**
 * This service can be used in order to assure unique parameter names
 * across all of the QueryCriteriaBuilders.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class ParameterGenerator implements ParameterGeneratorInterface
{
    /**
     * @var int internal counter of parameters
     */
    private $counter;

    /**
     * @var string prefix for all of the parameters
     */
    private $prefix;

    /**
     * @param string $prefix
     */
    public function __construct($prefix = 'searchParam')
    {
        $this->counter = 0;
        $this->prefix = $prefix;
    }

    /**
     * @inheritdoc
     */
    public function getParameterName()
    {
        $this->counter += 1;

        return sprintf('%s%s', $this->prefix, $this->counter);
    }
}
