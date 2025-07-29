<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AllClothController extends Controller
{
    public function index()
    {
        $allCategories = [
            'Gift' => 'গিফট প্যাক',
            // 👔 পুরুষদের পোশাক
            'Panjabi' => 'পাঞ্জাবি',
            'Jubba' => 'জুব্বা',
            'Shirt' => 'শার্ট',
            'T-Shirt' => 'টি-শার্ট',
            'Pants' => 'প্যান্ট',
            'Jeans' => 'জিন্স',
            'Lungi' => 'লুঙ্গি',
            'Pajama' => 'পাজামা',
            'Suit' => 'সুট',
            'Waistcoat' => 'ওয়েস্টকোট',
            'Sweater' => 'সুইটার',
            'Jacket' => 'জ্যাকেট',
            'Blazer' => 'ব্লেজার',
            'Undershirt' => 'গেঞ্জি',
            'Underwear' => 'জাঙ্গিয়া',

            // 👗 নারীদের পোশাক
            'Saree' => 'শাড়ি',
            'Salwar Kameez' => 'সালওয়ার কামিজ',
            'Kurti' => 'কুর্তি',
            'Leggings' => 'লেগিংস',
            'Blouse' => 'ব্লাউজ',
            'Dupatta' => 'দুপাত্তা',
            'Hijab' => 'হিজাব',
            'Abaya' => 'আবায়া',
            'Burkha' => 'বোরখা',
            'Gown' => 'গাউন',
            'Lehenga' => 'লেহেঙ্গা',
            'Skirt' => 'স্কার্ট',
            'Top' => 'টপ',
            'Nighty' => 'নাইটি',
            'Bra' => 'ব্রা',
            'Panty' => 'প্যান্টি',
            'Camisole' => 'ক্যামিসোল',

            // 🧥 উভয় লিঙ্গের
            'Cap' => 'টুপি',
            'Scarf' => 'স্কার্ফ',
            'Shoes' => 'জুতা',
            'Sandal' => 'স্যান্ডেল',
            'Slippers' => 'স্লিপার',
            'Socks' => 'মোজা',
            'Raincoat' => 'রেইনকোট',
            'Umbrella' => 'ছাতা (অ্যাকসেসরিজ)',

            // 👶 শিশুদের পোশাক
            'Baby Frock' => 'শিশুদের ফ্রক',
            'Baby Pajama' => 'শিশুদের পায়জামা',
            'Baby Shirt' => 'শিশুদের শার্ট',
            'Baby Shoes' => 'শিশুদের জুতা',
        ];

        $categoryProducts = [];

        foreach ($allCategories as $key => $name) {
            $products = Product::whereJsonContains('category', $key)
                ->latest()
                ->take(5)
                ->get();

            if ($products->isNotEmpty()) {
                $categoryProducts[$key] = [
                    'name' => $name,
                    'products' => $products
                ];
            }
        }

        return view('frontend.all-cloth', compact('categoryProducts'));
    }
}
