<?php

namespace KGzocha\Searcher\Chain;

/**
 * Use this class to indicate that there is no more searchers in the chain.
 * It is like a NullObject. It does not do much.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
final class EndTransformer implements TransformerInterface
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
