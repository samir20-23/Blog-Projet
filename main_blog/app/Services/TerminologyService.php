<?php

namespace App\Services;

class TerminologyService
{
    protected $terms;

    public function __construct()
    {
        $path = config_path('terminology.json');
        if (file_exists($path)) {
            $this->terms = json_decode(file_get_contents($path), true);
        } else {
            $this->terms = [];
        }
    }

    public function get($key, $default = null)
    {
        return $this->terms[$key] ?? $default ?? ucfirst(str_replace('_', ' ', $key));
    }

    public function getAll()
    {
        return $this->terms;
    }
}
