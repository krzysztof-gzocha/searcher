<?php

namespace KGzocha\Searcher\Criteria;

/**
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
