<?php

namespace KGzocha\Searcher\Criteria;

/**
 * In some cases you might find AlwaysAppliedCriteria useful, as you might use it to trigger
 * some CriteriaBuilder, which will add some very important constraints to the QueryBuilder
 *
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class AlwaysAppliedCriteria implements CriteriaInterface
{
    /**
     * @inheritDoc
     */
    public function shouldBeApplied()
    {
        return true;
    }
}
