<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductComponent extends Component
{

    public $name;
    public $description;
    public $category_id;
    public $categories;
    public $products;
    public $productId = null;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'category_id' => 'required|exists:categories,id',
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->loadProducts();
    }

    public function render()
    {
        return view('product.product-component');
    }

    public function loadProducts()
    {
        $this->products = Product::with('category')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $product = Product::find($this->productId);
            $product->update([
                'name' => $this->name,
                'description' => $this->description,
                'category_id' => $this->category_id,
            ]);
            $this->isEditing = false;
        } else {
            Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'category_id' => $this->category_id,
            ]);
        }

        $this->resetForm();
        $this->loadProducts();
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->isEditing = true;
    }

    public function delete($id)
    {
        Product::destroy($id);
        $this->loadProducts();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->category_id = null;
        $this->productId = null;
        $this->isEditing = false;
    }
}
