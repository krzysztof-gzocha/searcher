<?php

namespace KGzocha\Searcher\Chain;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class EmptyTransformer implements TransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform($results)
    {
        throw new \RuntimeException(
            'Transform method on EmptyTransformer should never be called.'
        );
    }

    /**
     * @inheritDoc
     */
    public function skip($results)
    {
        return false;
    }
}
