<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{
    public function render()
    {
        return view('category.category-component');
    }

    public $categories;
    public $name;
    public $categoryId = null;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::all();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $category = Category::find($this->categoryId);
            $category->update(['name' => $this->name]);
            $this->isEditing = false;
        } else {
            Category::create(['name' => $this->name]);
        }

        $this->resetForm();
        $this->loadCategories();
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->isEditing = true;
    }

    public function delete($id)
    {
        Category::destroy($id);
        $this->loadCategories();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->categoryId = null;
        $this->isEditing = false;
    }

}
