<?php

namespace KGzocha\Searcher\Test\Criteria;

use KGzocha\Searcher\Criteria\AlwaysAppliedCriteria;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class AlwaysAppliedCriteriaTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldBeApplied()
    {
        $criteria = new AlwaysAppliedCriteria();

        $this->assertTrue($criteria->shouldBeApplied());
    }
}
