<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Category;

class CategorySelector extends Component
{
    public array $selectedCategories = [];
    public array $levels = [];

    public function mount()
    {
        $this->levels = [
            Category::whereNull('parent_id')->get()
        ];
    }

    public function updated(string $property)
    {
        if (str_starts_with($property, 'selectedCategories.')) {
            $level = (int) explode('.', $property)[1];
            $value = $this->selectedCategories[$level] ?? null;

            $this->selectedCategories = array_slice($this->selectedCategories, 0, $level + 1);
            $this->levels = array_slice($this->levels, 0, $level + 1);

            if ($value) {
                $children = Category::where('parent_id', $value)->get();
                if ($children->isNotEmpty()) {
                    $this->levels[] = $children;
                }
            }
        }
    }

    public function updatedSelectedCategories()
    {
        $this->dispatch('categoryPathUpdated', $this->selectedCategories);
    }

    public function render()
    {
        return view('livewire.category-selector');
    }
}
