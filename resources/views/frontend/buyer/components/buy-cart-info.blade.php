<div class="bg-[#f9fafb] text-gray-800 font-sans mt-5">
    <!-- Main Body -->
    <div class="max-w-7xl mx-auto px-6 py-10">
            <!-- Profile Info -->
            <div class=" bg-white rounded-xl mt-2 shadow p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">👤 Profile Details</h3>
                <ul class="text-sm space-y-2 text-gray-700">
                    <li><span class="font-medium">Email:</span> {{ $user->email }}</li>
                    <li><span class="font-medium">Phone:</span> {{ $user->phone }}</li>
                    <li><span class="font-medium">Address:</span> {{ $user->address }}</li>
                </ul>
            </div>
    </div>
</div>
