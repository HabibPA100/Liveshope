<footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Logo & About -->
            <div>
                <div class="flex items-center mb-4 space-x-3">
                    <!-- Logo SVG -->
                    <img src="{{ asset('frontend/images/logo/logo.png') }}" alt="Logo" width="50px" height="50px">
                    <!-- Logo Text -->
                    <h2 class="text-3xl font-extrabold text-white">Live Shope</h2>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    "মানুষের জীবনে ইতিবাচক পরিবর্তনের সহযাত্রী হয়ে, আমরা এগিয়ে যেতে চাই উন্নয়নের আলোকিত পথে।"
                </p>

                <!-- Optional Social Media Icons -->
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="hover:text-indigo-400 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-blue-400 transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-pink-400 transition"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition">🏠 Home</a></li>
                    <li><a href="{{ route('about.us') }}" class="text-gray-400 hover:text-white transition">ℹ️ About Us</a></li>
                    <li><a href="{{ route('service') }}" class="text-gray-400 hover:text-white transition">🛒 Services</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition">✉️ Contact</a></li>
                    <li><a href="{{ route('terms.condition') }}" class="text-gray-400 hover:text-white transition">📃 Terms & Conditions</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white transition">🔒 Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Contact Us</h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><span class="font-medium text-white">Email:</span> mslabdulazim2025@gmail.com</li>
                    <li><span class="font-medium text-white">Phone:</span> +880 1403022986</li>
                    <li><span class="font-medium text-white">Address:</span> Demra Dhaka-1361, Bangladesh</li>
                </ul>
            </div>
        </div>

        <!-- Divider & Copyright -->
        <div class="border-t border-gray-700 mt-12 pt-6 text-center text-sm text-gray-500">
            &copy; 2025 Live Shope. All rights reserved. Designed by Habib PA.
        </div>
    </div>
</footer>
