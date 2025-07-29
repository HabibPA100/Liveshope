<?php 

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClothCreate extends Component
{
    use WithFileUploads;

    public $image;
    public $title;
    public $price;
    public $rating;

    protected $rules = [
        'image' => 'required|image|max:1024', // 1MB max
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'rating' => 'required|numeric|min:0|max:5',
    ];

    public function save()
    {
        $this->validate();

        // Store the image
        $imagePath = $this->image->store('products', 'public');

        // এখানে আপনি প্রোডাক্ট মডেল ব্যবহার করে ডেটাবেইজে সেভ করতে পারেন
        // উদাহরণ:
        Product::create([
            'title' => $this->title,
            'price' => $this->price,
            'rating' => $this->rating,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Product created successfully!');
        
        // ফর্ম ক্লিয়ার
        $this->reset(['image', 'title', 'price', 'rating']);
    }

    public function render()
    {
        return view('livewire.cloth-create');
    }
}
