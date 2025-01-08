<?php

namespace App\Livewire;

use App\Models\Atribute;
use App\Models\Category;
use Livewire\Component;

class AtributeCompoennt extends Component
{
    public $attributeList; // Renamed from $attributes to $attributeList
    public $categories;
    public $name;
    public $category_id;
    public $attributeId = null;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
    ];

    public function mount()
    {
        $this->loadAttributes();
        $this->categories = Category::all();
    }

    public function loadAttributes()
    {
        $this->attributeList = Atribute::with('category')->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $attribute = Atribute::find($this->attributeId);
            $attribute->update([
                'name' => $this->name,
                'category_id' => $this->category_id,
            ]);
            $this->isEditing = false;
        } else {
            Atribute::create([
                'name' => $this->name,
                'category_id' => $this->category_id,
            ]);
        }

        $this->resetForm();
        $this->loadAttributes();
    }

    public function edit($id)
    {
        $attribute = Atribute::find($id);
        $this->attributeId = $attribute->id;
        $this->name = $attribute->name;
        $this->category_id = $attribute->category_id;
        $this->isEditing = true;
    }

    public function delete($id)
    {
        Atribute::destroy($id);
        $this->loadAttributes();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->category_id = null;
        $this->attributeId = null;
        $this->isEditing = false;
    }

    public function render()
    {
        return view('atribute.atribute-compoennt');
    }

}
