<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewProductCreate extends Component
{
    use WithFileUploads;

    public $productId;
    public $product_image;
    public $slash_image;
    public $title;
    public $description;
    public $status = 'in stock';
    public $offer_price;
    public $real_price;
    public $category_path = [];
    public $category_id;
    public $views = 0;
    public $seller_id;

    // নতুন ইনপুট ফিল্ডগুলো
    public $sku;
    public $brand;
    public $discount_percent;
    public $tags = [];
    public $stock_quantity;
    public $weight;
    public $dimensions;
    public $colors = [];
    public $sizes = [];
    public $warranty;
    public $shipping_info;
    public $published_at;
    public $is_featured = false;
    public $rating;
    public $quality;

    protected $listeners = [
        'categoryPathUpdated' => 'updateCategoryPath',
        'editProduct' => 'edit',
    ];

    public function rules()
    {
        return [
            'product_image' => ($this->productId && Product::find($this->productId)?->product_image)
                ? 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:3072'
                : 'required|image|mimes:jpg,png,jpeg,gif,webp,avif|max:3072',

            'slash_image' => ($this->productId && Product::find($this->productId)?->slash_image)
                ? 'nullable|image|mimes:jpg,png,jpeg,gif,webp,avif|max:3072'
                : 'required|image|mimes:jpg,png,jpeg,gif,webp,avif|max:3072',

            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:in stock,out of stock',
            'offer_price' => 'required|numeric',
            'real_price' => 'required|numeric',

            'category_path' => [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    foreach ($value as $catId) {
                        if (!is_numeric($catId)) {
                            $fail('সব ক্যাটেগরি ID অবশ্যই সংখ্যা হতে হবে।');
                            break;
                        }
                    }
                },
            ],

            'category_id' => 'required|exists:categories,id',
            'views' => 'nullable|integer',
            'rating' => 'nullable|string',
            'quality' => 'nullable|string',
            'sku' => 'nullable|string|unique:products,sku,' . $this->productId,
            'brand' => 'nullable|string|max:100',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'tags' => 'nullable|array',
            'stock_quantity' => 'required|integer|min:0',
            'weight' => 'nullable|numeric',
            'dimensions' => 'nullable|string',
            'colors' => 'nullable|array',
            'sizes' => 'nullable|array',
            'warranty' => 'nullable|string',
            'shipping_info' => 'nullable|string',
            'published_at' => 'nullable|date',
            'is_featured' => 'boolean',
        ];
    }

    public function updateCategoryPath(array $selectedCategories)
    {
        $this->category_path = $selectedCategories;
        // সর্বশেষ ক্যাটেগরি ID সেভ করতে চাইলে
        $this->category_id = end($selectedCategories);
    }

    public function save()
    {
        $this->validate();

        $timestamp = now()->format('Ymd_His');
        $random = Str::random(5);

        // product_image আপলোড এবং স্টোরেজ
        if ($this->product_image) {
            $productImageName = 'product_' . $timestamp . '_' . $random . '.' . $this->product_image->getClientOriginalExtension();
            $productImagePath = $this->product_image->storeAs('products', $productImageName, 'public');
        } else {
            $productImagePath = Product::find($this->productId)?->product_image;
        }

        // slash_image আপলোড এবং স্টোরেজ
        if ($this->slash_image) {
            $slashImageName = 'slash_' . $timestamp . '_' . $random . '.' . $this->slash_image->getClientOriginalExtension();
            $slashImagePath = $this->slash_image->storeAs('slashes', $slashImageName, 'public');
        } else {
            $slashImagePath = Product::find($this->productId)?->slash_image;
        }

        $product = Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
                'offer_price' => $this->offer_price,
                'real_price' => $this->real_price,
                'category_path' => $this->category_path,
                'category_id' => $this->category_id,
                'views' => $this->views,
                'seller_id' => Auth::id(),
                'product_image' => $productImagePath,
                'slash_image' => $slashImagePath,
                'sku' => $this->sku,
                'brand' => $this->brand,
                'discount_percent' => $this->discount_percent,
                'tags' => $this->tags,
                'stock_quantity' => $this->stock_quantity,
                'weight' => $this->weight,
                'dimensions' => $this->dimensions,
                'colors' => $this->colors,
                'sizes' => $this->sizes,
                'warranty' => $this->warranty,
                'shipping_info' => $this->shipping_info,
                'published_at' => $this->published_at,
                'is_featured' => $this->is_featured,
                'rating' => $this->rating,
                'quality' => $this->quality,
            ]
        );

        $this->dispatch('swal:success', data: [
            'title' => $this->title,
            'text' => 'আপনি সফলভাবে একটি পণ্য যুক্ত করেছেন! ধন্যবাদ।',
        ]);

        $this->resetExcept('status');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)
            ->where('seller_id', Auth::id())
            ->firstOrFail();

        $this->fill($product->toArray());
        $this->productId = $product->id;

        // category_path কে অ্যাসাইন করতে চাইলে:
        $this->category_path = $product->category_path ?? [];
        $this->category_id = $product->category_id ?? null;
    }

    public function delete(Product $product)
    {
        $product->delete();
        session()->flash('message', 'Product deleted successfully!');
    }

    public function render()
    {
        return view('livewire.new-product-create', [
            'products' => Product::where('seller_id', Auth::id())->latest()->get(),
        ]);
    }
}
