<div>
    <div class="mb-4">
        <form wire:submit.prevent="save">
            <select wire:model="product_id" class="border rounded px-4 py-2">
                <option value="">Select Product</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            @error('product_id') <p class="text-red-500">{{ $message }}</p> @enderror

            <input type="text" wire:model="title" class="border rounded px-4 py-2 mt-2"
                placeholder="Enter Element Title">
            @error('title') <p class="text-red-500">{{ $message }}</p> @enderror

            <input type="number" wire:model="price" class="border rounded px-4 py-2 mt-2" placeholder="Enter Price">
            @error('price') <p class="text-red-500">{{ $message }}</p> @enderror

            <select name="" wire:model="attribute_charactiristic_id" class="border rounded px-4 py-2 mt-2">
                <option value="">Select Attribute</option>
                @foreach($attrebute_charactiristics as $attrebute_charactiristic)
                <option value="{{ $attrebute_charactiristic->id }}">{{ $attrebute_charactiristic->characteristic->name }} {{ $attrebute_charactiristic->attribute->name }} 
                </option>
                @endforeach
            </select>
            @error('attribute_charactiristic_id') <p class="text-red-500">{{ $message }}</p> @enderror

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">
                {{ $isEditing ? 'Update' : 'Add' }}
            </button>

            @if ($isEditing)
            <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded mt-2">
                Cancel
            </button>
            @endif
        </form>
    </div>

    <table class="table w-full text-center dark:text-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Title</th>
                <th>Price</th>
                <th>Attrebute Charactiristic</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($elements as $index => $element)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $element->product->name }}</td>
                <td>{{ $element->title }}</td>
                <td>{{ $element->price }}</td>
                <td>{{ $element->attribute_charactiristics[0]->characteristic->name ?? ''  }}  {{ $element->attribute_charactiristics[0]->attribute->name ?? '' }}</td>
                <td>
                    <button wire:click="edit({{ $element->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">
                        Edit
                    </button>
                    <button wire:click="delete({{ $element->id }})" class="bg-red-500 text-white px-2 py-1 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>