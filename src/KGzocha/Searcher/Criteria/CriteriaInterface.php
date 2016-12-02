<?php
declare(strict_types=1);

namespace KGzocha\Searcher\Criteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @author Daniel Ribeiro <drgomesp@gmail.com>
 */
interface CriteriaInterface
{
    /**
     * Checks if the query criteria should be applied when building the query.
     *
     * @return bool
     */
    public function shouldBeApplied(): bool;
}
