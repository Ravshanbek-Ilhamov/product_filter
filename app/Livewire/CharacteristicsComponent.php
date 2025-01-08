<?php

namespace App\Livewire;

use App\Models\Atribute;
use App\Models\Characteristic;
use Livewire\Component;

class CharacteristicsComponent extends Component
{
    public function render()
    {
        $this->attributeLists = Atribute::all();
        return view('characteristics.characteristics-component');
    }

    public $name;
    public $selectedAttributes = [];
    public $attributeLists;
    public $characteristics;
    public $characteristicId = null;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'selectedAttributes' => 'required',
    ];

    public function mount()
    {
        $this->loadCharacteristics();
    }

    public function loadCharacteristics()
    {
        $this->characteristics = Characteristic::with('attributes')->get();
    }

    public function save()
    {

        // dd($this->all());
        $this->validate();

        // if ($this->isEditing) {
        // $characteristic = Characteristic::find($this->characteristicId);
        // $characteristic->update(['name' => $this->name]);
        // $characteristic->attributes()->sync($this->selectedAttributes);
        // $this->isEditing = false;
        // } else {
        $characteristic = Characteristic::create(['name' => $this->name]);
        $characteristic->attributes()->attach($this->selectedAttributes);
        // }

        $this->resetForm();
        $this->loadCharacteristics();
    }

    public function update()
    {
        $this->validate();
        $characteristic = Characteristic::find($this->characteristicId);
        $characteristic->update(['name' => $this->name]);
        $characteristic->attributes()->sync($this->selectedAttributes);
        $this->isEditing = false;
        $this->reset();
        $this->loadCharacteristics();
    }

    public function edit($id)
    {
        $characteristic = Characteristic::find($id);
        $this->characteristicId = $characteristic->id;
        $this->name = $characteristic->name;
        $this->selectedAttributes = $characteristic->attributes->pluck('id')->toArray();
        $this->isEditing = true;
    }

    public function delete($id)
    {
        Characteristic::destroy($id);
        $this->loadCharacteristics();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->selectedAttributes = [];
        $this->characteristicId = null;
        $this->isEditing = false;
    }
}
