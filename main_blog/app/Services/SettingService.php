<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function get($key, $default = null)
    {
        return Setting::get($key, $default);
    }

    public function set($key, $value, $type = 'text', $group = 'general')
    {
        return Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'display_name' => ucwords(str_replace('_', ' ', $key)), 'type' => $type, 'group' => $group]
        );
    }

    public function getAllByGroup($group)
    {
        return Setting::where('group', $group)->get()->pluck('value', 'key');
    }
}
