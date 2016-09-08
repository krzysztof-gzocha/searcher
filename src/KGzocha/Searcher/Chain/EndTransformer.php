<?php

namespace KGzocha\Searcher\Chain;

use KGzocha\Searcher\Criteria\Collection\CriteriaCollectionInterface;

/**
 * Use this class to indicate that there is no more searchers in the chain.
 * It is like a NullObject. It does not do much.
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
final class EndTransformer implements TransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($results, CriteriaCollectionInterface $criteria)
    {
        throw new \RuntimeException(
            'Transform method on EmptyTransformer should never be called.'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function skip($results)
    {
        return false;
    }
}
