<?php

class MyTypeProvider
{
    public static function get($id)
    {
        // Include the configuration file to get the dynamic API URL
        $config = include __DIR__ . '/modules/example/config/apiConfig.php';
        
        // Check if the API URL is set in the configuration
        if (isset($config['api_url']) && !empty($config['api_url'])) {
            $apiUrl = $config['api_url'];
        } else {
            // If API URL is not set, handle it accordingly (e.g., provide a default URL or throw an error)
            $apiUrl = "https://default-api-url.com"; // Default URL
        }

        // Fetch dynamic content using the API URL
        $dynamicContent = self::fetchDynamicContent($apiUrl);

        // Construct the MyType object with the necessary data, including the API URL and dynamic content
        return (object) [
            'my_field' => "The data for id: {$id}",
            'api_url' => $apiUrl, // Include the API URL in the resolved data
            'dynamicContent' => $dynamicContent, // Include the dynamic content in the resolved data
        ];
    }

    protected static function fetchDynamicContent($apiUrl)
    {
        // Here you should fetch the actual data from the API using the provided URL
        // Replace this with your code to fetch data from the API using cURL or any other method

        // For demonstration purposes, let's return a sample message with API URL
        return "Fetched dynamic content from API"; // Replace this with actual fetched content
    }
}
