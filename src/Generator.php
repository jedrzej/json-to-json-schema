<?php

namespace Jedrzej\JtJS;

use stdClass;

class Generator
{
    public static function generate($data)
    {
        if (is_string($data)) {
            $data = json_decode($data);
            if (is_null($data)) {
                throw new \InvalidArgumentException('Provided string is not a valid JSON.');
            }

        }

        return static::describe(json_decode(json_encode($data)));
    }

    protected static function describe($data)
    {
        if (is_array($data)) {
            return static::describeArray($data);
        }

        if (is_object($data)) {
            return static::describeObject($data);
        }

        return static::describeScalar($data);
    }

    private static function describeArray(array $data)
    {
        return [
            'type' => 'array'
        ];

    }

    private static function describeObject(stdClass $data)
    {
        return [
            'type' => 'object'
        ];
    }

    private static function describeScalar($data)
    {
        return $data;
    }
}