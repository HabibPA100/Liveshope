<?php
use App\Models\Category;

if (! function_exists('getCategoryPath')) {
    function getCategoryPath(Category $category)
    {
        $slugs = [];
        while ($category) {
            array_unshift($slugs, $category->slug);
            $category = $category->parent;
        }
        return implode('/', $slugs);
    }
}
