<?php

namespace Jedrzej\JtJS;

use stdClass;

class Generator
{
    public static function generate($data)
    {
        if (is_string($data)) {
            $data = json_decode($data);
        }

        return static::describe($data);
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
        return $data;
    }

    private static function describeObject(stdClass $data)
    {
        return $data;
    }

    private static function describeScalar($data)
    {
        return $data;
    }
}