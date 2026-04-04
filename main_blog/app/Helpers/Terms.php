<?php

if (!function_exists('app_term')) {
    /**
     * Get the configured terminology for a given key.
     *
     * @param string $key
     * @return string
     */
    function app_term($key)
    {
        static $terminology = null;

        if (is_null($terminology)) {
            $path = config_path('terminology.json');
            if (file_exists($path)) {
                $terminology = json_decode(file_get_contents($path), true);
            } else {
                $terminology = [];
            }
        }

        return $terminology[$key] ?? ucfirst(str_replace('_', ' ', $key));
    }
}
