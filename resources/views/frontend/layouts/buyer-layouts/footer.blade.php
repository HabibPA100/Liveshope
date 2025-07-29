<footer class="bg-white border-t mt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
        <div class="mb-4 sm:mb-0">
            &copy; {{ date('Y') }} Life Shope. All rights reserved.
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('privacy') }}" class="hover:text-blue-600 transition">Privacy Policy</a>
            <a href="{{ route('terms.condition') }}" class="hover:text-blue-600 transition">Terms</a>
        </div>
    </div>
</footer>
