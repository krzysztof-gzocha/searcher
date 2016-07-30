<?php

namespace KGzocha\Searcher\Test\CriteriaBuilder\Collection;

use KGzocha\Searcher\CriteriaBuilder\Collection\CriteriaBuilderCollection;

class CriteriaBuilderCollectionTest extends \PHPUnit_Framework_TestCase
{
    const NUMBER_OF_FILTER_IMPOSERS = 5;

    /**
     * @param mixed $params
     * @expectedException \InvalidArgumentException
     * @dataProvider wrongParamsDataProvider
     */
    public function testConstructorWithWrongParameter($params = null)
    {
        new CriteriaBuilderCollection($params);
    }

    /**
     * @return array
     */
    public function wrongParamsDataProvider()
    {
        return [
            [0],
            [1.2],
            [new \stdClass()],
            [''],
            []
        ];
    }

    public function testConstructor()
    {
        $builders = [];

        for ($i = 1; $i <= self::NUMBER_OF_FILTER_IMPOSERS; $i++) {
            $builders[] = $this->getCriteriaBuilder();
        }

        $buildersCollection = new CriteriaBuilderCollection($builders);

        $this->assertCount(self::NUMBER_OF_FILTER_IMPOSERS, $buildersCollection->getCriteriaBuilders());
    }

    public function testFilteringByContext()
    {
        $collection = new CriteriaBuilderCollection([
            $this->getCriteriaBuilderSupportingContext(true),
            $this->getCriteriaBuilderSupportingContext(true),
            $this->getCriteriaBuilderSupportingContext(true),
            $this->getCriteriaBuilderSupportingContext(false),
            $this->getCriteriaBuilderSupportingContext(false),
            $this->getCriteriaBuilderSupportingContext(false),
        ]);

        $this->assertCount(3, $collection->getCriteriaBuildersForContext(
            $this->getSearchingContext()
        ));
    }

    public function testFluentInterface()
    {
        $collection = new CriteriaBuilderCollection();
        $this->assertInstanceOf(
            '\KGzocha\Searcher\CriteriaBuilder\Collection\CriteriaBuilderCollection',
            $collection->addCriteriaBuilder(
                $this->getCriteriaBuilder()
            )
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getCriteriaBuilder()
    {
        return $this
            ->getMockBuilder('\KGzocha\Searcher\CriteriaBuilder\CriteriaBuilderInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param $result
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getCriteriaBuilderSupportingContext($result)
    {
        $criteriaBuilder = $this->getCriteriaBuilder();
        $criteriaBuilder
            ->expects($this->any())
            ->method('supportsSearchingContext')
            ->withAnyParameters()
            ->willReturn($result);

        return $criteriaBuilder;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getSearchingContext()
    {
        return $this
            ->getMockBuilder(
                '\KGzocha\Searcher\Context\SearchingContextInterface'
            )
            ->getMock();
    }
}

