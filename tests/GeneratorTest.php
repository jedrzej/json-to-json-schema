<?php

namespace Jedrzej\JtJS\Test;

use InvalidArgumentException;
use Jedrzej\JtJS\Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use stdClass;

class GeneratorTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidJson()
    {
        Generator::generate("I'm not JSON");
    }

    public function testDescribeList()
    {
        $data = [1, 2, 3];

        $schema = [
            'type' => 'array'
        ];

        Assert::assertEquals($schema, Generator::generate($data));
        Assert::assertEquals($schema, Generator::generate(json_encode($data)));
    }

    public function testDescribeArray()
    {
        $data = [
            'stringValue'  => 'value',
            'booleanValue' => false,
            'numberValue'  => 3.14,
            'nullValue'    => null,
            'listValue'    => [1, 2, 3],
            'arrayValue'   => ['attribute' => 'value'],
            'objectValue'  => (object)['attribute' => 'value'],
        ];

        $schema = [
            'type'       => 'object',
            'properties' => [
                'stringValue'  => [
                    'type' => 'string',
                ],
                'booleanValue' => [
                    'type' => 'boolean',
                ],
                'numberValue'  => [
                    'type' => 'number',
                ],
                'nullValue'    => [
                    'type' => 'null',
                ],
                'listValue'    => [
                    'type' => 'array'
                ],
                'arrayValue'   => [
                    'type'       => 'object',
                    'properties' => [
                        'attribute' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'objectValue'  => [
                    'type'       => 'object',
                    'properties' => [
                        'attribute' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
        ];

        Assert::assertEquals($schema, Generator::generate($data));
        Assert::assertEquals($schema, Generator::generate(json_encode($data)));
    }

    public function testDescribeObject()
    {
        $data = new stdClass;
        $data->stringValue = 'value';
        $data->booleanValue = true;
        $data->numberValue = 3.14;
        $data->nullValue = null;
        $data->listValue = [1, 2, 3];
        $data->arrayValue = ['attribute' => 'value'];
        $data->objectValue = (object)['attribute' => 'value'];

        $schema = [
            'type'       => 'object',
            'properties' => [
                'stringValue'  => [
                    'type' => 'string',
                ],
                'booleanValue' => [
                    'type' => 'boolean',
                ],
                'numberValue'  => [
                    'type' => 'number',
                ],
                'nullValue'    => [
                    'type' => 'null',
                ],
                'listValue'    => [
                    'type' => 'array'
                ],
                'arrayValue'   => [
                    'type'       => 'object',
                    'properties' => [
                        'attribute' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'objectValue'  => [
                    'type'       => 'object',
                    'properties' => [
                        'attribute' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
        ];

        Assert::assertEquals($schema, Generator::generate($data));
        Assert::assertEquals($schema, Generator::generate(json_encode($data)));
    }
}
