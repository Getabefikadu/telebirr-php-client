<?php

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return  null;
        }

        if (strlen($value) > 1 && starts_with($value, '"') && ends_with($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (! function_exists('starts_with')) {
    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function starts_with($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}

if (! function_exists('ends_with')) {
    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string  $haystack
     * @param  string|array  $needles
     * @return bool
     */
    function ends_with($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}

if (! function_exists('array_keys_exists_and_not_empty')) {
    /**
     * Determine if a given keys exists in the stack.
     *
     * @param  array $haystack
     * @param  string[]|int[] $needles
     * @return bool
     */
    function array_keys_exists_and_not_empty($haystack, $needles)
    {
        foreach ($needles as $needle) {
            if (!array_key_exists($needle, $haystack) ) return false;
            if (empty($haystack[$needle])) return false;
        }

        return true;
    }
}

if (! function_exists('str_contains')) {
    /**
     * Determine if a string contains a given sub string.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  string  $haystack
     * @param  string  $needle
     * @return bool
     */
    function str_contains($haystack, $needle)
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

if (! function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function config($key, $default = null)
    {
        $config = include('../configs/config.php');

        if (!str_contains($key, '.')) {
            return array_key_exists($key, $config)
                ? $config[$key]
                : value($default);
        }

        foreach (explode('.', $key) as $segment) {
            if (!array_key_exists($segment, $config)) {
                return value($default);
            }

            $config = $config[$segment];
        }

        return $config;
    }
}
