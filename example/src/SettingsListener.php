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

        // Output dynamic content using API URL retrieved from customizer configuration
        return self::outputDynamicContent($config);
    }

    protected static function outputDynamicContent(Config $config)
    {
        $apiUrl = $config->get('customizer.panels.recipes_api_data.fields.api_url');

        // Debug: Output raw data retrieved from customizer
        echo "Customizer Data: " . json_encode($config->get('customizer'), JSON_PRETTY_PRINT) . "<br>";

        // Debug: Output API URL retrieved from customizer
        echo "API URL retrieved from customizer: " . var_export($apiUrl, true) . "<br>";

        if (is_string($apiUrl)) {
            // Fetch dynamic content using the API URL
            $dynamicContent = self::fetchDynamicContent($apiUrl);

            if ($dynamicContent !== false) {
                // Return the dynamic content
                return $dynamicContent;
            } else {
                // Output error message if fetching data fails
                return "ERROR FETCHING DATA FROM THE API.";
            }
        } elseif (is_array($apiUrl)) {
            // Output error message if API URL is an array
            return "API URL is an array in customizer. Please provide a valid URL.<br>"
                 . "ERROR FETCHING DATA FROM THE API.";
        } else {
            // Output error message if API URL is not set or is not a valid string
            return "API URL is not set in customizer or is not a valid string<br>"
                 . "ERROR FETCHING DATA FROM THE API.";
        }
    }

    protected static function fetchDynamicContent($apiUrl)
    {
        // Here you should fetch the actual data from the API using the provided URL
        // Replace this with your code to fetch data from the API using cURL or any other method

        // For demonstration purposes, let's return a sample message with API URL
        return "Fetched dynamic content from API"; // Replace this with actual fetched content
    }
}
