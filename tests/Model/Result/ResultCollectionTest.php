<?php

namespace KGzocha\Searcher\Test\Model\Result;

use KGzocha\Searcher\Model\Result\ResultCollection;

/**
 * @author Krzysztof Gzocha <krzysztof@propertyfinder.ae>
 * @package KGzocha\Searcher\Test\Model\Result
 */
class ResultCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $inputArray
     * @param int $expectedCount
     * @dataProvider numberOfElementsDataProvider
     */
    public function testNumberOfElements($inputArray, $expectedCount)
    {
        $result = new ResultCollection($inputArray);

        $this->assertCount($expectedCount, $result);
    }

    /**
     * @return array
     */
    public function numberOfElementsDataProvider()
    {
        return [
            [[1, 2, 3], 3],
            [[1, 2, 3, 4, 5], 5],
            [[1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 10],
            [[], 0]
        ];
    }

    /**
     * @param array $inputArray
     * @param string $expectedOutput
     * @dataProvider jsonSerializableDataProvider
     */
    public function testJsonSerializable($inputArray, $expectedOutput)
    {
        $result = new ResultCollection($inputArray);

        $this->assertEquals(json_encode($result), $expectedOutput);
    }

    /**
     * @return array
     */
    public function jsonSerializableDataProvider()
    {
        $object = new \stdClass();
        $object->a = 1;
        $object->b = 2;

        return [
            [[1, 2, 3], json_encode([1, 2, 3])],
            [[1, 2, 3, 4, 5], json_encode([1, 2, 3, 4, 5])],
            [[], json_encode([])],
            [[$object], json_encode([$object])],
            [['someKey' => $object], json_encode(['someKey' => $object])],
        ];
    }

    public function testIteratable()
    {
        $result = new ResultCollection([1, 2, 3]);

        $i = 0;
        foreach ($result as $value) {
            $i++;
        }

        $this->assertEquals(3, $i);
    }
}
