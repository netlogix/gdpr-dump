<?php

namespace machbarmacher\GdprDump\ColumnTransformer\Plugins;

use Faker\Factory;
use Faker\Provider\Base;
use machbarmacher\GdprDump\ColumnTransformer\ColumnTransformer;

class FakerColumnTransformer extends ColumnTransformer
{

    private static $factory;

    public static $formatterTansformerMap = [
        'name' => 'name',
        'firstName' => 'firstName',
        'lastName' => 'lastName',
        'phoneNumber' => 'phoneNumber',
        'username' => 'username',
        'password' => 'password',
        'email' => 'email',
        'safeEmail' => 'safeEmail',
        'uniqueEmail' => 'safeEmail',
        'date' => 'date',
        'longText' => 'paragraph',
        'number' => 'number',
        'randomText' => 'sentence',
        'text' => 'sentence',
        'uri' => 'url',
        'company' => 'company',
        'streetAddress' => 'streetAddress',
        'secondaryAddress' => 'secondaryAddress',
        'city' => 'city',
        'postcode' => 'postcode'
    ];

    public static $uniqueFormatterTransformers = [
        'uniqueEmail' => true,
    ];

    protected function getSupportedFormatters()
    {
        return array_keys(self::$formatterTansformerMap);
    }

    public function __construct()
    {
        if (!isset(self::$factory)) {
            self::$factory = Factory::create();
        }
    }

    public function getValue($expression)
    {
        if (isset(self::$uniqueFormatterTransformers[$expression['formatter']])) {
            $factory = self::$factory->unique();
        } else {
            $factory = self::$factory;
        }
        return $factory->format(self::$formatterTansformerMap[$expression['formatter']]);
    }
}
