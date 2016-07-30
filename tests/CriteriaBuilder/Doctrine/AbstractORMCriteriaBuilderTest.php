<?php

namespace KGzocha\Searcher\Test\CriteriaBuilder\Doctrine;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use KGzocha\Searcher\Context\SearchingContextInterface;
use KGzocha\Searcher\CriteriaBuilder\Doctrine\AbstractORMCriteriaBuilder;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 */
class AbstractORMCriteriaBuilderTest extends \PHPUnit_Framework_TestCase
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
        /** @var AbstractORMCriteriaBuilder $criteriaBuilder */
        $criteriaBuilder = $this
            ->getMockBuilder('\KGzocha\Searcher\CriteriaBuilder\Doctrine\AbstractORMCriteriaBuilder')
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
     * @param bool $sameJoinType
     * @param bool $sameAlias
     * @param bool $sameJoin
     * @param bool $shouldJoinBeColled
     * @dataProvider filterExistingJoinDataProvider
     */
    public function testFilterExistingJoins(
        $sameJoinType = true,
        $sameAlias = true,
        $sameJoin = true,
        $shouldJoinBeColled = false
    ) {
        $builder = new ORMCriteriaBuilderStub();
        $joinType = Join::INNER_JOIN;
        $join = 'entityName.newEntityName';
        $alias = 'newEntity';

        $joinParts = [
            new Join($joinType, $join, $alias)
        ];

        $builder->filterExistingJoins(
            $this->getQueryBuilderMock($shouldJoinBeColled),
            $joinParts,
            $sameAlias ? $alias : 'differentAlias',
            $sameJoin ? $join : 'otherEntity.otherEntityName',
            $sameJoinType ? $joinType : Join::LEFT_JOIN
        );
    }

    /**
     * @return array
     */
    public function filterExistingJoinDataProvider()
    {
        return [
            [true, true, true, false],

            [true, true, false, true],
            [true, false, false, true],
            [false, false, false, true],
            [false, true, false, true],
            [false, true, true, true],
        ];
    }

    /**
     * @param $sameEntityName
     * @param $joinWillBeCalled
     * @dataProvider joinMethodDataProvider
     */
    public function testJoinMethod($sameEntityName, $joinWillBeCalled)
    {
        $builder = new ORMCriteriaBuilderStub();
        $alreadyDefinedJoins = [
            'entityName' => [
                new Join(Join::LEFT_JOIN, 'entityName.newEntityName', 'alias')
            ]
        ];

        $builder->join(
            $this->getQueryBuilderMock($joinWillBeCalled, $alreadyDefinedJoins),
            $sameEntityName ? 'entityName.newEntityName' : 'newEntity.newerEntity',
            'alias',
            Join::LEFT_JOIN
        );
    }

    public function joinMethodDataProvider()
    {
        return [
            [true, false],
            [false, true],
        ];
    }

    /**
     * @param bool $joinWillBeCalled
     * @param array $joinParts
     *
     * @return QueryBuilder|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getQueryBuilderMock(
        $joinWillBeCalled = false,
        array $joinParts = []
    ) {
        $mock = $this
            ->getMockBuilder('\Doctrine\ORM\QueryBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $mock
            ->expects($joinWillBeCalled ? $this->once() : $this->never())
            ->method('join')
            ->willReturnSelf();

        $mock
            ->expects($this->any())
            ->method('getDQLPart')
            ->willReturn($joinParts);

        return $mock;
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
            ->getMockBuilder('\KGzocha\Searcher\Context\Doctrine\QueryBuilderSearchingContext')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
