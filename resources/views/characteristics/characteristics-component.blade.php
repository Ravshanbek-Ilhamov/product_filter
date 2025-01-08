<div>
    <h1 class="text-xl font-bold mb-4">Characteristics Management</h1>

    <div class="mb-4">
        {{-- <form wire:submit.prevent="save"> --}}
            <div class="mb-2">
                <label for="name" class="block font-medium">Name</label>
                <input type="text" id="name" wire:model="name"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-2">
                <label for="attributes" class="block font-medium">Attributes</label>
                <select id="attributes" wire:model="selectedAttributes"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    @foreach ($attributeLists as $attribute)
                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                    @endforeach
                </select>
                @error('selectedAttributes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            @if (!$isEditing)
            <button wire:click="save" class="bg-blue-500 text-white px-4 py-2 rounded">
                Save
            </button>
            @else
            <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded">
                Update
            </button>
            @endif
            @if($isEditing)
            <button wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
                Cancel
            </button>
            @endif
            {{--
        </form> --}}
    </div>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Attributes</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($characteristics as $index => $characteristic)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $characteristic->name }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    {{ $characteristic->attributes->pluck('name')->join(', ') }}
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <button wire:click="edit({{ $characteristic->id }})"
                        class="bg-yellow-500 text-white px-2 py-1 rounded">
                        Edit
                    </button>
                    <button wire:click="delete({{ $characteristic->id }})"
                        class="bg-red-500 text-white px-2 py-1 rounded">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>