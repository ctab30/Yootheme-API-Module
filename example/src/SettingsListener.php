<?php

use YOOtheme\Config;
use YOOtheme\Path;

class SettingsListener
{
    public static function initCustomizer(Config $config)
    {
        // Recipes API Data panel with API settings
        $config->set('customizer.panels.recipes_api_data', [
            'title' => 'Recipes API Data',
            'width' => 400,
            'fields' => [
                'api_url' => [
                    'label' => 'API URL',
                    'description' => 'Enter the URL of the API endpoint.',
                    'type' => 'text',
                ],
                'api_key' => [
                    'label' => 'API Key',
                    'description' => 'Enter your API key.',
                    'type' => 'text',
                ],
            ],
        ]);

        // Add section, using a static JSON configuration as an example
        $config->addFile('customizer', Path::get('../config/customizer.json'));

        // Output dynamic content using API URL retrieved from customizer configuration
        return self::outputDynamicContent($config);
    }

    protected static function outputDynamicContent(Config $config)
    {
        $apiUrl = $config->get('customizer.panels.recipes_api_data.fields.api_url');

        if (is_string($apiUrl)) {
            // Fetch dynamic content using the API URL
            $dynamicContent = self::fetchDynamicContent($apiUrl);

            if ($dynamicContent !== false) {
                // Return the dynamic content
                return $dynamicContent;
            } else {
                // Return error message if fetching data fails
                return "ERROR FETCHING DATA FROM THE API.";
            }
        } elseif (is_array($apiUrl)) {
            // Return error message if API URL is an array
            return "API URL is an array in customizer. Please provide a valid URL.<br>"
                 . "ERROR FETCHING DATA FROM THE API.";
        } else {
            // Return error message if API URL is not set or is not a valid string
            return "API URL is not set in customizer or is not a valid string<br>"
                 . "ERROR FETCHING DATA FROM THE API.";
        }
    }

    protected static function fetchDynamicContent($apiUrl)
    {
        // Here, you can implement code to fetch dynamic content from the API
        // Replace this with your actual code to fetch data from the API
        return "Fetched dynamic content from API";
    }
}