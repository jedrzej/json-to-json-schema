<?php

namespace Jedrzej\JtJS\Test;

use InvalidArgumentException;
use Jedrzej\JtJS\Generator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidJson() {
       Generator::generate("I'm not JSON");
    }

    public function test()
    {
        $data = [
          'array' => [1, 2, 3],
          'object' => ['attribute' => 'value'],
          'scalar' => 5,
        ];

        Assert::assertEquals($data, Generator::generate($data));

        Assert::assertEquals(json_decode(json_encode($data)), Generator::generate(json_encode($data)));
    }
}
