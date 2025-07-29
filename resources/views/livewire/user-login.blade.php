<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
  <div class="max-w-md w-full bg-white p-8 rounded shadow">
    <a href="{{ url('/') }}" class="p-2 bg-purple-400 rounded-lg hover:bg-gray-600 text-white">Home</a>
    <h2 class="text-2xl font-bold mb-6 text-center">User Login</h2>

    {{-- ✅ Success message --}}
    @if(session()->has('success'))
      <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    {{-- ✅ Error message --}}
    @if(session()->has('error'))
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        {{ session('error') }}
      </div>
    @endif

    <form wire:submit.prevent="login">

      {{-- 👤 User Type --}}
      <div class="mb-4">
        <label for="user_type" class="block text-gray-700 mb-1">Login As</label>
        <select id="user_type" wire:model="userType"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">-- Select --</option>
          <option value="buyer">Buyer</option>
          <option value="seller">Seller</option>
          <option value="admin">Admin</option>
        </select>
        @error('userType') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- 📧 Email --}}
      <div class="mb-4">
        <label for="email" class="block text-gray-700 mb-1">Email Address</label>
        <input type="email" id="email" wire:model.defer="email" required
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="email" />
        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- 🔑 Password --}}
      <div class="mb-2">
        <label for="password" class="block text-gray-700 mb-1">Password</label>
        <input type="password" id="password" wire:model.defer="password" required
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      {{-- 🔗 Forgot Password --}}
      <div class="text-right mb-4">
        @if($userType)
          <a href="{{ route('password.request', $userType) }}" class="text-sm text-blue-600 hover:underline">
            Forgot Password?
          </a>
        @else
          <span class="text-sm text-gray-500">Select user type to reset password</span>
        @endif
      </div>

      {{-- 🔘 Submit --}}
      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200"
        >
        Login
      </button>
    </form>

    {{-- 🔗 Register Links --}}
    <p class="mt-4 text-center text-gray-600">
      Don't have an account? <a href="{{ route('buyer') }}" class="text-blue-600 hover:underline">ক্রেতা</a>
    </p>
    <p class="mt-2 text-center text-gray-600">
      Don't have an account? <a href="{{ route('seller') }}" class="text-blue-600 hover:underline">বিক্রেতা</a>
    </p>
    <p class="mt-2 text-center text-gray-600">
      Admin Account Need? <a href="{{ route('admin.account.create') }}" class="text-blue-600 hover:underline">এডমিন</a>
    </p>
  </div>
</div>
