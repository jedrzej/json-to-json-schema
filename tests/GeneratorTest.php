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
    public function testInvalidJson() {
       Generator::generate("I'm not JSON");
    }

    public function testDescribeList() {
        $data = [1,2,3];

        $schema = ['type' => 'array'];

        Assert::assertEquals($schema, Generator::generate($data));
        Assert::assertEquals($schema, Generator::generate(json_encode($data)));
    }

    public function testDescribeArray() {
        $data = ['attribute' => 'value'];

        $schema = ['type' => 'object'];

        Assert::assertEquals($schema, Generator::generate($data));
        Assert::assertEquals($schema, Generator::generate(json_encode($data)));
    }

    public function testDescribeObject() {
        $data = new stdClass;
        $data->attribute = 'value';

        $schema = ['type' => 'object'];

        Assert::assertEquals($schema, Generator::generate($data));
        Assert::assertEquals($schema, Generator::generate(json_encode($data)));
    }
}
