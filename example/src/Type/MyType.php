<?php

class MyType
{
    public static function config()
    {
        return [
            'fields' => [
                'recipes' => [
                    'type' => 'String', // Assuming the API returns JSON string data
                    'metadata' => [
                        'label' => 'Recipes',
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolveRecipes',
                    ],
                ],
            ],
            'metadata' => [
                'type' => true,
                'label' => 'My Type',
            ],
        ];
    }

    public static function resolveRecipes($obj, $args, $context, $info)
    {
        // Check if dynamic content is provided
        if (isset($obj->dynamicContent)) {
            // Return the dynamic content
            return $obj->dynamicContent;
        } else {
            // Return default message if dynamic content is not available
            return 'No recipes available.';
        }
    }
}
