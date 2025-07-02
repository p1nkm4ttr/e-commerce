<div class="container mx-auto p-4">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="mb-6 bg-white p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700">Name</label>
                <input type="text" wire:model="name" class="w-full border rounded px-3 py-2">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-gray-700">Username</label>
                <input type="text" wire:model="username" class="w-full border rounded px-3 py-2">
                @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" wire:model="email" class="w-full border rounded px-3 py-2">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-gray-700">Password</label>
                <input type="password" wire:model="password" class="w-full border rounded px-3 py-2">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" wire:model="is_admin" class="form-checkbox">
                    <span class="ml-2">Admin User</span>
                </label>
            </div>
            <div class="col-span-2">
                <label class="block text-gray-700 mb-2">Roles</label>
                <div class="flex flex-wrap gap-4">
                    @foreach($roles as $role)
                        <label class="inline-flex items-center">
                            <input type="checkbox" 
                                   wire:model="selectedRoles" 
                                   value="{{ $role->id }}" 
                                   class="form-checkbox">
                            <span class="ml-2">{{ ucfirst($role->name) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit" class="mt-4 bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">
            {{ $isEditing ? 'Update' : 'Save' }}
        </button>
    </form>

    <!-- Pickers Table -->
    <div class="bg-white rounded-lg shadow mb-6">
        <h2 class="p-4 border-b text-xl font-semibold">Pickers</h2>
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Username</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pickers as $user)
                    <tr class="border-t">
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->username }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <button wire:click="edit({{ $user->id }})" class="bg-green-500 text-black px-4 py-1 rounded">
                                EDIT
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Packers Table -->
    <div class="bg-white rounded-lg shadow mb-6">
        <h2 class="p-4 border-b text-xl font-semibold">Packers</h2>
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Username</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packers as $user)
                    <tr class="border-t">
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->username }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <button wire:click="edit({{ $user->id }})" class="bg-green-500 text-black px-4 py-1 rounded">
                                EDIT
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- All Users Table -->
    <div class="bg-white rounded-lg shadow">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Username</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Role</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="py-3 px-4">{{ $user->name }}</td>
                        <td class="py-3 px-4">{{ $user->username }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                        <td class="py-3 px-4">
                            <button wire:click="edit({{ $user->id }})" class="bg-green-500 text-black px-4 py-1 rounded">
                                EDIT
                            </button>
                            <button wire:click="delete({{ $user->id }})" class="bg-red-500 text-black px-4 py-1 rounded">
                                DELETE
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4 border-t">
            {{ $users->links() }}
        </div>
    </div>
</div>