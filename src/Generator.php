<?php

namespace Jedrzej\JtJS;

use InvalidArgumentException;

class Generator
{
    public static function generate($data)
    {
        if (is_string($data)) {
            $data = json_decode($data);
            if (is_null($data)) {
                throw new InvalidArgumentException('Provided string is not a valid JSON.');
            }

        }

        return static::describe(json_decode(json_encode($data)));
    }

    protected static function describe($data)
    {
        if (is_string($data)) {
            return [
                'type' => 'string',
            ];
            $description['type'] = 'string';
        }

        if (is_numeric($data)) {
            return [
                'type' => 'number',
            ];
        }

        if (is_bool($data)) {
            return [
                'type' => 'boolean',
            ];
        }

        if (is_null($data)) {
            return [
                'type' => 'null',
            ];
        }

        if (is_array($data)) {
            return [
                'type' => 'array',
            ];
        }

        if (is_object($data)) {
            $description = [
              'type' => 'object',
              'properties' => [],
            ];

            foreach ($data as $attribute => $value) {
                $description['properties'][$attribute] = static::describe($value);
            }

            return $description;
        }

        throw new InvalidArgumentException('Unrecognized type: ' . var_export($data, true));
    }
}