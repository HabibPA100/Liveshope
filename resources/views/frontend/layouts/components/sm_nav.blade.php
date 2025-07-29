<!-- Mobile Bottom Navbar -->
<div class="fixed animated-rainbow bottom-0 left-0 right-0 z-50  shadow-lg">
  <div class="flex justify-around items-center py-2">
    
    <!-- হোম -->
    <a href="{{ url('/') }}" class="flex flex-col items-center text-white hover:text-yellow-300 transition">
      <i class="fa-solid fa-house text-xl"></i>
      <span class="text-xs mt-1">হোম</span>
    </a>

    <!-- যোগাযোগ -->
    <a href="{{ route('contact') }}" class="flex flex-col items-center text-white hover:text-yellow-300 transition">
      <i class="fa-solid fa-phone-volume text-xl"></i>
      <span class="text-xs mt-1">যোগাযোগ</span>
    </a>

    <!-- পে -->
    <a href="{{ route('seller') }}" class="flex flex-col items-center text-white hover:text-yellow-300 transition">
      <i class="fa-solid fa-spa text-xl"></i>
      <span class="text-xs">বিক্রয় করুন</span>
    </a>

    <!-- ভর্তি -->
    <a href="{{ route('buyer.dashboard') }}" class="flex flex-col items-center text-white hover:text-yellow-300 transition">
      <i class="fa-solid fa-cart-shopping text-xl"></i>
      <span class="text-xs mt-1">অর্ডার</span>
    </a>

    <!-- লগইন -->
    <a href="{{ route('login') }}" class="flex flex-col items-center text-white hover:text-yellow-300 transition">
      <i class="fa-solid fa-right-to-bracket text-xl"></i>
      <span class="text-xs mt-1">লগইন</span>
    </a>

  </div>
</div>
