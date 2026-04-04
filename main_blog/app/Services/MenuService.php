<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\MenuItem;

class MenuService
{
    public function getMenuBySlug($slug)
    {
        return Menu::with(['items.children'])->where('slug', $slug)->first();
    }

    public function createMenuItem(array $data)
    {
        return MenuItem::create($data);
    }

    public function updateMenuItem(MenuItem $item, array $data)
    {
        return $item->update($data);
    }

    public function deleteMenuItem(MenuItem $item)
    {
        return $item->delete();
    }
}
