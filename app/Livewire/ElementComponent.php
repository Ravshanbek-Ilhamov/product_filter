<?php

namespace App\Livewire;

use App\Models\AttributeCharactiristic;
use App\Models\Element;
use App\Models\Product;
use Livewire\Component;

class ElementComponent extends Component
{
    public $elements, $products, $product_id, $title, $price, $element_id,$attrebute_charactiristics, $attribute_charactiristic_id;
    public $isEditing = false;

    protected $rules = [
        'product_id' => 'required|exists:products,id',
        'title' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'attribute_charactiristic_id' => 'required|exists:attribute_charactiristics,id',
    ];

    public function mount()
    {
        $this->attrebute_charactiristics = AttributeCharactiristic::all();
        $this->products = Product::all();
        $this->elements = Element::with('product')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $element = Element::find($this->element_id);
            $element->update([
                'product_id' => $this->product_id,
                'title' => $this->title,
                'price' => $this->price,
            ]);

            $element->attribute_charactiristics()->sync($this->attribute_charactiristic_id);
        } else {
            $element = Element::create([
                'product_id' => $this->product_id,
                'title' => $this->title,
                'price' => $this->price,
            ]);

            $element->attribute_charactiristics()->attach($this->attribute_charactiristic_id);

        }

        $this->resetForm();
        $this->elements = Element::with('product')->get();
    }

    public function edit($id)
    {
        $element = Element::find($id);
        $this->element_id = $id;
        $this->product_id = $element->product_id;
        $this->title = $element->title;
        $this->price = $element->price;
        $this->isEditing = true;
    }

    public function delete($id)
    {
        Element::find($id)->delete();
        $this->elements = Element::with('product')->get();
    }

    public function resetForm()
    {
        $this->product_id = '';
        $this->title = '';
        $this->price = '';
        $this->isEditing = false;
    }

    public function render()
    {
        return view('element.element-component');
    }
}
