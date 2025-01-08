<div>
    <div class="mb-4">
        <form wire:submit.prevent="save">
            <input type="text" wire:model="name" class="border rounded px-4 py-2" placeholder="Enter Attribute Name">
            <select wire:model="category_id" class="border rounded px-4 py-2">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ $isEditing ? 'Update' : 'Add' }}
            </button>
            @if ($isEditing)
            <button type="button" wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </button>
            @endif
        </form>
        @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
        @error('category_id') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    <table class="table w-full text-center dark:text-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Attribute Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributeList as $index => $attribute)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $attribute->name }}</td>
                <td>{{ $attribute->category->name }}</td>
                <td>
                    <button wire:click="update({{ $attribute->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">
                        Edit
                    </button>
                    <button wire:click="delete({{ $attribute->id }})" class="bg-red-500 text-white px-2 py-1 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>