<?php

namespace KGzocha\Searcher\Test\CriteriaBuilder\Doctrine;

use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\Doctrine\AbstractODMCriteriaBuilder;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class AbstractODMCriteriaBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param SearchingContextInterface $searchingContext
     * @param                           $expected
     * @dataProvider supportedContextDataProvider
     */
    public function testSupportSearchingContext(
        SearchingContextInterface $searchingContext,
        $expected
    ) {
        /** @var AbstractODMCriteriaBuilder $criteriaBuilder */
        $criteriaBuilder = $this
            ->getMockBuilder('\KGzocha\Searcher\CriteriaBuilder\Doctrine\AbstractODMCriteriaBuilder')
            ->getMockForAbstractClass();

        $this->assertEquals(
            $expected,
            $criteriaBuilder->supportsSearchingContext($searchingContext)
        );
    }

    public function supportedContextDataProvider()
    {
        return [
            [$this->getSupportedSearchingContextMock(), true],
            [$this->getNotSupportedSearchingContextMock(), false],
        ];
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getNotSupportedSearchingContextMock()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\Context\SearchingContextInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getSupportedSearchingContextMock()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\Context\Doctrine\ODMBuilderSearchingContext')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
