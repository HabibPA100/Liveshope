<!-- Admin Table -->
    <div class="mt-10 max-w-5xl mx-auto" data-aos="fade-up">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Admin Users</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded overflow-hidden">
                <thead class="bg-indigo-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">NID</th>
                        <th class="py-3 px-4 text-left">DOB</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $index => $admin)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $index + 1 }}</td>
                            <td class="py-3 px-4">{{ $admin->name }}</td>
                            <td class="py-3 px-4">{{ $admin->email }}</td>
                            <td class="py-3 px-4">{{ $admin->nid }}</td>
                            <td class="py-3 px-4">{{ $admin->dob }}</td>
                            <td class="py-3 px-4 text-center space-x-2">
                                <button wire:click="edit({{ $admin->id }})"
                                        class="text-blue-600 hover:underline">Edit</button>
                                <button wire:click="delete({{ $admin->id }})"
                                        onclick="return confirm('Are you sure?')"
                                        class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">No admin users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $admins->links() }}
        </div>
    </div>