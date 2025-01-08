<div>
    <div class="mb-4">
        <form wire:submit.prevent="save">
            <input type="text" wire:model="name" class="border rounded px-4 py-2" placeholder="Enter Category Name">
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
    </div>

    <table class="table w-full text-center dark:text-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <button wire:click="edit({{ $category->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">
                        Edit
                    </button>
                    <button wire:click="delete({{ $category->id }})" class="bg-red-500 text-white px-2 py-1 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>