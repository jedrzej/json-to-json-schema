<?php

namespace Jedrzej\JtJS;

use Exception;
use InvalidArgumentException;
use JsonSchema\Validator;

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

        $data = json_decode(json_encode($data));
        $schema = static::describe($data);

        static::validate($data, $schema);

        return $schema;
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
                'type'                 => 'object',
                'properties'           => [],
                'additionalProperties' => false,
            ];

            foreach ($data as $attribute => $value) {
                $description['properties'][$attribute] = static::describe($value);
            }

            $description['required'] = array_keys((array)$data);

            return $description;
        }

        throw new InvalidArgumentException('Unrecognized type: ' . var_export($data, true));
    }

    protected static function validate($data, $schema)
    {
        $validator = new Validator();
        if ($validator->validate($data, $schema)) {
            throw new Exception('Unable to generate JSON Schema that would match provided data.');
        }
    }
}