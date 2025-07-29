<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class GetCartController extends Controller
{
    // ProductController.php

    public function showByCategoryPath($categoryPath)
    {
        $slugs = explode('/', $categoryPath);
        $parentId = null;
        $category = null;

        foreach ($slugs as $slug) {
            $category = Category::where('slug', $slug)
                                ->where('parent_id', $parentId)
                                ->firstOrFail();

            $parentId = $category->id;
        }

        // Get all subcategories
        $categoryIds = $this->getAllCategoryIds($category);

        $products = Product::with('category')->whereIn('category_id', $categoryIds)->paginate(12);

        return view('frontend.categories.index', compact('products', 'category'));
    }

    private function getAllCategoryIds(Category $category)
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }

        return $ids;
    }

}
